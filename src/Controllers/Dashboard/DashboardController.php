<?php

namespace App\Controllers\Dashboard;

use App\Controllers\Controller;
use App\Config\Auth;
use App\Interfaces\User\IUser;
use App\Interfaces\Venda\IVenda;

class DashboardController extends Controller {

    protected $auth;
    protected $userRepository;
    protected $vendaRepository;

    public function __construct(IUser $userRepository, IVenda $vendaRepository, Auth $auth){
        parent::__construct();
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->vendaRepository = $vendaRepository;
    }

    public function index(){
        $user = $this->auth->user();

        $usuarios = $this->userRepository->all();

        $last_sales = $this->vendaRepository->all(['data' => '2025-06-01', 'situacao' => 'concluida']);

        return $this->router->view('dashboard/index', [
            'user' => $user,
            'usuarios' => $usuarios,
            'last_sales' => $last_sales
        ]);
    }

}