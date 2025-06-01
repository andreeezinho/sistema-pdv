<?php

namespace App\Controllers\Pdv;

use App\Request\Request;
use App\Controllers\Controller;
use App\Config\Auth;
use App\Interfaces\User\IUser;
use App\Interfaces\Venda\IVenda;

class PdvController extends Controller {

    protected $auth;
    protected $userRepository;
    protected $vendaRepository;

    public function __construct(IUser $userRepository, IVenda $vendaRepository, Auth $auth){
        parent::__construct();
        $this->auth = $auth;
        $this->userRepository = $userRepository;
        $this->vendaRepository = $vendaRepository;
    }

    public function index(Request $request){
        return $this->router->view('pdv/index', []);
    }

    public function finalizar(Request $request){
        return $this->router->view('pdv/finalizar', []);
    }

}