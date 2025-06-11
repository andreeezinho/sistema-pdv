<?php

namespace App\Controllers\Venda;

use App\Request\Request;
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

    public function __construct(IUser $userRepository, IVenda $vendaRepository, IVendaProduto $vendaProdutoRepository, IProduto $produtoRepository, IPagamento $pagamentoRepository, IVendaPagamento $vendaPagamentoRepository, PdfService $pdfService){
        parent::__construct();
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

        return $this->router->view('venda/index', [
            'vendas' => $vendas,
            'usuario' => $params['usuario'] ?? null,
            'total' => $params['total'] ?? null,
            'data' => $params['data'] ?? null,
            'situacao' => $params['situacao'] ?? null
        ]);
    }

}