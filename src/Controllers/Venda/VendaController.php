<?php

namespace App\Controllers\Venda;

use App\Request\Request;
use App\Config\Auth;
use App\Controllers\Controller;
use App\Services\Pdf\PdfService;
use App\Interfaces\User\IUser;
use App\Interfaces\Venda\IVenda;
use App\Interfaces\Venda\IVendaProduto;
use App\Interfaces\Venda\IVendaPagamento;
use App\Interfaces\Produto\IProduto;
use App\Interfaces\Pagamento\IPagamento;

class VendaController extends Controller {

    protected $auth;
    protected $pdfService;
    protected $userRepository;
    protected $vendaRepository;
    protected $vendaProdutoRepository;
    protected $produtoRepository;
    protected $pagamentoRepository;
    protected $vendaPagamentoRepository;

    public function __construct(IUser $userRepository, IVenda $vendaRepository, IVendaProduto $vendaProdutoRepository, IProduto $produtoRepository, IPagamento $pagamentoRepository, IVendaPagamento $vendaPagamentoRepository, PdfService $pdfService, Auth $auth){
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
        $params = $request->getQueryParams();

        $vendas = $this->vendaRepository->all($params);

        $vendaPagamento = $this->vendaPagamentoRepository->all();

        return $this->router->view('venda/index', [
            'vendas' => $vendas,
            'vendaPagamento' => $vendaPagamento,
            'usuario' => $params['usuario'] ?? null,
            'total' => $params['total'] ?? null,
            'data' => $params['exact_data'] ?? null,
            'situacao' => $params['situacao'] ?? null
        ]);
    }

    public function viewSaleInfos(Request $request, $uuid){
        $venda = $this->vendaRepository->findByUuid($uuid);

        if(!$venda){
            return $this->router->redirect('404');
        }

        $vendedor = $this->userRepository->findById($venda->usuarios_id);

        $allProductsInSale = $this->vendaProdutoRepository->allProductsOnSale($venda->id);

        $pagamento = $this->vendaPagamentoRepository->findBySaleId($venda->id);

        $pagamento = $this->pagamentoRepository->findById($pagamento->pagamento_id);

        return $this->router->view('venda/sale-info', [
            'venda' => $venda,
            'vendedor' => $vendedor,
            'allProductsInSale' => $allProductsInSale,
            'pagamento' => $pagamento
        ]);
    }

    public function viewProofSale(Request $request, $uuid){
        $venda = $this->vendaRepository->findByUuid($uuid);

        if(!$venda){
            return $this->router->redirect('404');
        }

        $allProductsInSale = $this->vendaProdutoRepository->allProductsOnSale($venda->id);

        return $this->pdfService->generateProof($venda, $allProductsInSale);
    }

    public function cancelSale(Request $request, $uuid){
        $user = $this->auth->user();

        $vendaPagamento = $this->vendaPagamentoRepository->all();
        $vendas = $this->vendaRepository->all();

        if(!$user->is_admin){
           return $this->router->view('venda/index', [
                'vendas' => $vendas,
                'vendaPagamento' => $vendaPagamento,
                'erro' => 'Permissão necessária não encontrada'
            ]);
        }

        $venda = $this->vendaRepository->findByUuid($uuid);

        if(!$venda){
            return $this->router->redirect('404');
        }

        $cancel = $this->vendaRepository->updateSituation('cancelada', $venda->id);

        if(!$cancel){
            return $this->router->view('venda/index', [
                'vendas' => $vendas,
                'vendaPagamento' => $vendaPagamento,
                'erro' => 'ão foi possível cancelar a venda'
            ]);
        }

        return $this->router->redirect('vendas');
    }

}