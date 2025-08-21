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
use App\Interfaces\Venda\IVenda;
use App\Repositories\Venda\VendaRepository;
use App\Interfaces\Venda\IVendaProduto;
use App\Repositories\Venda\VendaProdutoRepository;
use App\Interfaces\Produto\IProduto;
use App\Repositories\Produto\ProdutoRepository;
use App\Interfaces\Pagamento\IPagamento;
use App\Repositories\Pagamento\PagamentoRepository;
use App\Interfaces\Venda\IVendaPagamento;
use App\Repositories\Venda\VendaPagamentoRepository;
use App\Interfaces\Cliente\ICliente;
use App\Repositories\Cliente\ClienteRepository;
use App\Interfaces\Cliente\IVendaCliente;
use App\Repositories\Cliente\VendaClienteRepository;

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

        $this->container
            ->set(
                IVenda::class,
                new VendaRepository()
            );

        $this->container
            ->set(
                IVendaProduto::class,
                new VendaProdutoRepository()
            );
        
        $this->container
            ->set(
                IProduto::class,
                new ProdutoRepository()
            );

        $this->container
            ->set(
                IPagamento::class,
                new PagamentoRepository()
            );

        $this->container
            ->set(
                IVendaPagamento::class,
                new VendaPagamentoRepository()
            );

        $this->container
            ->set(
                ICliente::class,
                new ClienteRepository()
            );

    }

}