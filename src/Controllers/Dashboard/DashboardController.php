<?php

namespace App\Controllers\Dashboard;

use App\Controllers\Controller;
use App\Config\Auth;
use App\Interfaces\User\IUser;
use App\Interfaces\Venda\IVenda;
use App\Interfaces\Produto\IProduto;

class DashboardController extends Controller {

    protected $auth;
    protected $userRepository;
    protected $vendaRepository;
    protected $produtoRepository;

    public function __construct(IUser $userRepository, IVenda $vendaRepository, IProduto $produtoRepository, Auth $auth){
        parent::__construct();
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->vendaRepository = $vendaRepository;
        $this->produtoRepository = $produtoRepository;
    }

    public function index(){
        $user = $this->auth->user();

        $usuarios = $this->userRepository->all();

        $vendas = $this->vendaRepository->all();

        $last_sales = $this->vendaRepository->all(['data' => date("Y-m-d"), 'situacao' => 'concluida', 'dash' => true]);

        $produtos = $this->produtoRepository->all();

        return $this->router->view('dashboard/index', [
            'user' => $user,
            'usuarios' => $usuarios,
            'vendas' => $vendas,
            'produtos' => $produtos,
            'last_sales' => $last_sales
        ]);
    }

}