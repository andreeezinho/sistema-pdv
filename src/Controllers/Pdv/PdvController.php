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
use App\Interfaces\Produto\IProduto;
use App\Interfaces\Pagamento\IPagamento;

class PdvController extends Controller {

    protected $auth;
    protected $pdfService;
    protected $userRepository;
    protected $vendaRepository;
    protected $vendaProdutoRepository;
    protected $produtoRepository;
    protected $pagamentoRepository;
    protected $vendaPagamentoRepository;

    public function __construct(IUser $userRepository, IVenda $vendaRepository, IVendaProduto $vendaProdutoRepository, IProduto $produtoRepository, IPagamento $pagamentoRepository, IVendaPagamento $vendaPagamentoRepository, Auth $auth, PdfService $pdfService){
        parent::__construct();
        $this->auth = $auth;
        $this->pdfService = $pdfService;
        $this->userRepository = $userRepository;
        $this->vendaRepository = $vendaRepository;
        $this->vendaProdutoRepository = $vendaProdutoRepository;
        $this->produtoRepository = $produtoRepository;
        $this->pagamentoRepository = $pagamentoRepository;
        $this->vendaPagamentoRepository = $vendaPagamentoRepository;
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

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $allProductsInSale = $this->vendaProdutoRepository->allProductsOnSale($pdv->id);

        $totalPriceSale = priceWithDiscount($allProductsInSale);

        return $this->router->view('pdv/index', [
            'venda' => $pdv,
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
            'allPayments' => $allPayments,
            'pagamento' => $pagamento
        ]);
    }

    public function finish(Request $request, $uuid){
        $pdv = $this->vendaRepository->findByUuid($uuid);

        if(!$pdv){
            return $this->router->redirect('pdv');
        }

        $allPayments = $this->pagamentoRepository->all(['ativo' => 1]);

        $pagamento = $this->vendaPagamentoRepository->findBySaleId($pdv->id);

        $pagamento = $this->pagamentoRepository->findById($pagamento->pagamento_id);

        $totalPriceSale = $pdv->total;

        if(isset($pdv->total) || $pdv->total != 0){
            $allProductsInSale = $this->vendaProdutoRepository->allProductsOnSale($pdv->id);

            $totalPriceSale = priceWithDiscount($allProductsInSale);
        }

        $all_products = $this->produtoRepository->all();

        $subtractProduct = $this->produtoRepository->verifyProductQuantity($all_products, $allProductsInSale);

        if(!$subtractProduct){
            return $this->router->view('pdv/index', [
                'venda' => $pdv,
                'total' => $totalPriceSale,
                'allPayments' => $allPayments,
                'pagamento' => $pagamento,
                'erro' => 'Quantidade no estoque indisponível'
            ]);
        }

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

}