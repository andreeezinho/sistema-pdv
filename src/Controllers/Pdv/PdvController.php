<?php

namespace App\Controllers\Pdv;

use App\Request\Request;
use App\Controllers\Controller;
use App\Config\Auth;
use App\Services\Pdf\PdfService;
use App\Interfaces\User\IUser;
use App\Interfaces\Venda\IVenda;
use App\Interfaces\Venda\IVendaProduto;
use App\Interfaces\Venda\IVendaPagamento;
use App\Interfaces\Venda\IVendaCliente;
use App\Interfaces\Produto\IProduto;
use App\Interfaces\Pagamento\IPagamento;
use App\Interfaces\Cliente\ICliente;

class PdvController extends Controller {

    protected $auth;
    protected $pdfService;
    protected $userRepository;
    protected $vendaRepository;
    protected $vendaProdutoRepository;
    protected $vendaClienteRepository;
    protected $produtoRepository;
    protected $pagamentoRepository;
    protected $vendaPagamentoRepository;
    protected $clienteRepository;

    public function __construct(IUser $userRepository, IVenda $vendaRepository, IVendaProduto $vendaProdutoRepository, IProduto $produtoRepository, IPagamento $pagamentoRepository, IVendaPagamento $vendaPagamentoRepository, IVendaCliente $vendaClienteRepository, ICliente $clienteRepository, Auth $auth, PdfService $pdfService){
        parent::__construct();
        $this->auth = $auth;
        $this->pdfService = $pdfService;
        $this->userRepository = $userRepository;
        $this->vendaRepository = $vendaRepository;
        $this->vendaProdutoRepository = $vendaProdutoRepository;
        $this->vendaClienteRepository = $vendaClienteRepository;
        $this->produtoRepository = $produtoRepository;
        $this->pagamentoRepository = $pagamentoRepository;
        $this->vendaPagamentoRepository = $vendaPagamentoRepository;
        $this->clienteRepository = $clienteRepository;
    }

    public function index(Request $request){
        $user = $this->auth->user();

        $openSale = $this->vendaRepository->findByLastUserSale($user->id);

        if(!$openSale){
            $create = $this->vendaRepository->create([], $user->id);
            
            if(!$create){
                return $this->router->redirect('404');
            }

            return $this->router->redirect('pdv/'.$create->uuid);
        }

        return $this->router->redirect('pdv/'.$openSale->uuid);
    }

    public function pdv(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv || $pdv->situacao != 'em andamento'){
            return $this->router->redirect('pdv');
        }

        $allProductsInSale = $this->vendaProdutoRepository->allProductsOnSale($pdv->id);

        $totalPriceSale = priceWithDiscount($allProductsInSale);

        $vendas_suspensas = $this->vendaRepository->all([
            'situacao' => 'em espera',
            'usuario' => $this->auth->user()->usuario
        ]);

        $vendas_diarias = $this->vendaRepository->all([
            'usuario' => $this->auth->user()->usuario,
            'exact_data' => date('Y-m-d')
        ]);

        return $this->router->view('pdv/index', [
            'venda' => $pdv,
            'vendas_suspensas' => $vendas_suspensas,
            'vendas_diarias' => $vendas_diarias,
            'produtos' => $allProductsInSale,
            'total' => $totalPriceSale
        ]);
    }

    public function addProductInSale(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $data = $request->getBodyParams();

        $produto = $this->produtoRepository->findByCode($data['codigo']);

        if(!$produto){
            return $this->router->redirect('pdv');
        }

        $addProduct = $this->vendaProdutoRepository->create($data, $pdv->id, $produto->id);

        if(!$addProduct){
            return $this->router->redirect('404');
        }

        return $this->router->redirect('pdv');
    }

    public function removeProductInSale(Request $request, $uuid, $uuidProduto){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $vendaProduto = $this->vendaProdutoRepository->findByUuid($uuidProduto);

        if(!$vendaProduto){
            return $this->router->redirect('pdv');
        }

        $removeProduct = $this->vendaProdutoRepository->delete($vendaProduto->id, $pdv->id, $vendaProduto->produtos_id);
        
        if(!$removeProduct){
            return $this->router->redirect('404');
        }

        return $this->router->redirect('pdv');
    }

    public function suspendSale(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $venda_cliente = $this->vendaClienteRepository->findBySaleId($pdv->id);

        if(!$venda_cliente){
            $allPayments = $this->pagamentoRepository->all(['ativo' => 1]);

            if(isset($pdv->total) || $pdv->total != 0){
                $allProductsInSale = $this->vendaProdutoRepository->allProductsOnSale($pdv->id);

                $totalPriceSale = priceWithDiscount($allProductsInSale);
            }

            return $this->router->view('pdv/finalizar', [
                'venda' => $pdv,
                'total' => $totalPriceSale,
                'allPayments' => $allPayments,
                'erro' => 'Cliente precisa ser vinculado para suspender a venda'
            ]);
        }

        $suspend = $this->vendaRepository->updateSituation('em espera', $pdv->id);

        if(is_null($suspend)){
            return $this->router->redirect('pdv/'.$pdv->uuid.'/finalizar');
        }

        return $this->router->redirect('pdv');
    }

    public function releaseSale(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        
    }

    public function removeAllProducts(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $removeAllProducts = $this->vendaProdutoRepository->deleteAllProductsInSale($pdv->id);

        if(!$removeAllProducts){
            return $this->router->redirect('404');
        }

        return $this->router->redirect('pdv');
    }

    public function viewSaleInfos(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv || $pdv->situacao == 'concluida'){
            return $this->router->redirect('pdv');
        }

        $totalPriceSale = $pdv->total;

        if(isset($pdv->total) || $pdv->total != 0){
            $allProductsInSale = $this->vendaProdutoRepository->allProductsOnSale($pdv->id);

            $totalPriceSale = priceWithDiscount($allProductsInSale);
        }

        $allPayments = $this->pagamentoRepository->all(['ativo' => 1]);

        $pagamento = $this->vendaPagamentoRepository->findBySaleId($pdv->id);

        if(!is_null($pagamento)){
            $pagamento = $this->pagamentoRepository->findById($pagamento->pagamento_id);
        }

        return $this->router->view('pdv/finalizar', [
            'venda' => $pdv,
            'total' => $totalPriceSale,
            'allPayments' => $allPayments
        ]);
    }

    public function finish(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $all_products = $this->produtoRepository->all();

        $allPayments = $this->pagamentoRepository->all(['ativo' => 1]);

        $totalPriceSale = $pdv->total;  

        if(isset($pdv->total) || $pdv->total != 0){
            $allProductsInSale = $this->vendaProdutoRepository->allProductsOnSale($pdv->id);

            $totalPriceSale = priceWithDiscount($allProductsInSale);
        }

        $subtractProduct = $this->produtoRepository->verifyProductQuantity($all_products, $allProductsInSale);

        if(!$subtractProduct){
            return $this->router->view('pdv/finalizar', [
                'venda' => $pdv,
                'total' => $totalPriceSale,
                'allPayments' => $allPayments,
                'erro' => 'Quantidade no estoque indisponível'
            ]);
        }

        $pagamento = $this->vendaPagamentoRepository->findBySaleId($pdv->id);

        if(!$pagamento){
            return $this->router->view('pdv/finalizar', [
                'venda' => $pdv,
                'total' => $totalPriceSale,
                'allPayments' => $allPayments,
                'erro' => 'Insira uma forma de pagamento'
            ]);
        }

        $pagamento = $this->pagamentoRepository->findById($pagamento->pagamento_id);

        $finish = $this->vendaRepository->updateSituation('concluida', $pdv->id);

        if(is_null($finish)){
            return $this->router->redirect('pdv/'.$pdv->uuid.'/finalizar');
        }

        return $this->pdfService->generateProof($pdv, $allProductsInSale);
    }

    public function subtractPaidValue(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $data = $request->getBodyParams();

        $allProductsInSale = $this->vendaProdutoRepository->allProductsOnSale($pdv->id);

        $data = array_merge($data, ['total' => priceWithDiscount($allProductsInSale)]);
        
        $data['troco'] = priceWithDiscount($allProductsInSale, (float)$data['troco']);

        $update = $this->vendaRepository->update($data, $pdv->id);
        
        if(is_null($update)){
            echo json_encode([
                'errors' => 'Erro ao calcular troco, tente novamente'
            ]);

            exit();
        }

        echo json_encode([
            'troco' => $update->troco
        ]);
        
        exit();
    }

    public function findPaymentMethod(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $data = $request->getBodyParams();

        $pagamento = $this->pagamentoRepository->findById($data['pagamento']);

        if(!$pagamento){
            return $this->router->redirect('404');
        }

        $findBySaleId = $this->vendaPagamentoRepository->findBySaleId((int)$pdv->id);

        if(!is_null($findBySaleId)){
            $delete = $this->vendaPagamentoRepository->delete($pdv->id, $findBySaleId->pagamento_id);
        }

        $create = $this->vendaPagamentoRepository->create($pdv->id, $pagamento->id);

        if(is_null($create)){
            echo json_encode([
                'errors' => 'Forma de pagamento não encontrada'
            ]);

            exit();
        }

        echo json_encode([
            'id' => $pagamento->id,
            'forma' => $pagamento->forma
        ]);
        
        exit();
    }

    public function allClients(Request $request){
        $data = $request->getQueryParams();

        $clientes = $this->clienteRepository->all($data);

        echo json_encode($clientes);
        exit();
    }

    public function bindClientOnSale(Request $request, $uuid, $client_uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            echo json_encode([
                'errors' => 'Venda não encontrada'
            ]);

            exit();
        }

        $cliente = $this->clienteRepository->findByUuid($client_uuid);

        if(!$cliente){
            echo json_encode([
                'errors' => 'Cliente não encontrado'
            ]);

            exit();
        }

        if($this->vendaClienteRepository->findBySaleId($pdv->id)){
            $venda_cliente = $this->vendaClienteRepository->delete($pdv->id);

            if(!$venda_cliente){
                echo json_encode([
                    'errors' => 'Erro ao desvincular cliente antigo'
                ]);

                exit();
            }
        }

        $venda_cliente = $this->vendaClienteRepository->create([], $pdv->id, $cliente->id);

        if(is_null($venda_cliente)){
            echo json_encode([
                'errors' => 'Erro ao vincular cliente'
            ]);

            exit();
        }

        echo json_encode([
            'nome' => $cliente->nome,
            'doc' => $cliente->documento
        ]);
        exit();     
    }

    public function deleteClientLink(Request $request, $uuid, $client_uuid){}

}