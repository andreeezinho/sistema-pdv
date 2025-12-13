<?php

namespace App\Controllers\NotaFiscal\Entrada;

use App\Request\Request;
use App\Controllers\Controller;
use App\Services\NFe\NFeService;
use App\Interfaces\Cliente\ICliente;
use App\Interfaces\Fornecedor\IFornecedor;
use App\Interfaces\Venda\IVenda;
use App\Interfaces\Produto\IProduto;
use App\Services\Xml\XmlService;

class EntradaController extends Controller {

    protected $clienteRepository;
    protected $fornecedorRepository;
    protected $vendaRepository;
    protected $produtoRepository;
    protected $xmlService;

    public function __construct(ICliente $clienteRepository, IVenda $vendaRepository, IFornecedor $fornecedorRepository, IProduto $produtoRepository){
        parent::__construct();
        $this->clienteRepository = $clienteRepository;
        $this->fornecedorRepository = $fornecedorRepository;
        $this->vendaRepository = $vendaRepository;
        $this->produtoRepository = $produtoRepository;
        $this->xmlService = new XmlService();
    }

    public function index(Request $request){
        return $this->router->view('fiscal/entrada/index', [
            'fiscal' => []
        ]);
    }

    public function create(Request $request){
        return $this->router->view('fiscal/entrada/create', []);
    }

    public function searchNF(Request $request){
        $data = $request->getFileParams();

        $xmlData = $this->xmlService->generateXml($data['file']);

        echo json_encode($xmlData);

        exit();
    }

}