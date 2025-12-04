<?php

namespace App\Config;

use App\Repositories\User\UserRepository;
use App\Repositories\Permissao\PermissaoUserRepository;

class Auth {

    protected $permissaoUserRepository;
    protected $userRepository;

    public function __construct(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        $this->permissaoUserRepository = new PermissaoUserRepository();
        $this->userRepository = new UserRepository();
    }

    public function login($user){
        if(is_null($user)){
            return false;
        }

        $_SESSION['user'] = $user;

        $permissoes = $this->permissaoUserRepository->allUserPermissions($_SESSION['user']->id);
        $_SESSION['permissoes'] = $permissoes;

        return true;
    }

    public function check(){
        if(isset($_SESSION['user'])){
            return true;
        }

        return false;
    }

    public function logout(){
        $this->setOnline($_SESSION['user']->id, false);

        unset($_SESSION['user']);
        unset($_SESSION['permissoes']);
        session_destroy();
    }

    public function user(){
        return $_SESSION['user'] ?? null;
    }

    public function setOnline(int $id, int $online){
        return $this->userRepository->setOnline($id, $online);
    }
}