<?php

namespace App\Controllers\Produto;

use App\Request\Request;
use App\Controllers\Controller;
use App\Interfaces\Produto\IProduto;

class ProdutoController extends Controller {

    protected $produtoRepository;

    public function __construct(IProduto $produtoRepository){
        parent::__construct();
        $this->produtoRepository = $produtoRepository;
    }

    public function index(Request $request){
        $params = $request->getQueryParams();

        $produtos = $this->produtoRepository->all($params);

        return $this->router->view('produto/index', [
            'produtos' => $produtos
        ]);
    }

}