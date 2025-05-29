<?php

namespace App\Config;

use App\Interfaces\User\IUser;
use App\Repositories\User\UserRepository;
use App\Interfaces\User\IRecoveryPassword;
use App\Repositories\User\RecoveryPasswordRepository;
use App\Interfaces\Permissao\IPermissao;
use App\Repositories\Permissao\PermissaoRepository;
use App\Interfaces\Permissao\IPermissaoUser;
use App\Repositories\Permissao\PermissaoUserRepository;

class DependencyProvider {

    private $container;

    public function __construct(Container $container){
        $this->container = $container;
    }

    public function register(){

        $this->container
            ->set(
                IUser::class,
                new UserRepository()
            );

        $this->container
            ->set(
                IPermissao::class,
                new PermissaoRepository()
            );

        $this->container
            ->set(
                IPermissaoUser::class,
                new PermissaoUserRepository()
            );

        $this->container
            ->set(
                IRecoveryPassword::class,
                new RecoveryPasswordRepository()
            );

    }

}