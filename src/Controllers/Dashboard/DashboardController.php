<?php

namespace App\Controllers\Dashboard;

use App\Controllers\Controller;
use App\Config\Auth;
use App\Interfaces\User\IUser;

class DashboardController extends Controller {

    protected $auth;
    protected $userRepository;

    public function __construct(IUser $userRepository, Auth $auth){
        parent::__construct();
        $this->auth = $auth;
        $this->userRepository = $userRepository;
    }

    public function index(){
        $user = $this->auth->user();

        $usuarios = $this->userRepository->all();

        return $this->router->view('dashboard/index', [
            'user' => $user,
            'usuarios' => $usuarios
        ]);
    }

}