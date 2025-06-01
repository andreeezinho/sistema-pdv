<?php

namespace App\Controllers\Pdv;

use App\Request\Request;
use App\Controllers\Controller;
use App\Config\Auth;
use App\Interfaces\User\IUser;

class PdvController extends Controller {

    protected $auth;
    protected $userRepository;

    public function __construct(IUser $userRepository, Auth $auth){
        parent::__construct();
        $this->auth = $auth;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request){
        return $this->router->view('pdv/index', []);
    }

    public function finalizar(Request $request){
        return $this->router->view('pdv/finalizar', []);
    }

}