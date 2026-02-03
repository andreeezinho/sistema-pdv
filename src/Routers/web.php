<?php

use App\Config\Router;
use App\Config\Auth;
use App\Config\Container;
use App\Config\DependencyProvider;
use App\Controllers\User\UserController;
use App\Controllers\NotFound\NotFoundController;
use App\Controllers\Dashboard\DashboardController;
use App\Controllers\Permissao\PermissaoController;
use App\Controllers\Permissao\PermissaoUserController;
use App\Controllers\User\UserPerfilController;
use App\Controllers\User\RecoveryPasswordController;
use App\Controllers\Venda\VendaController;
use App\Controllers\Pdv\PdvController;
use App\Controllers\Produto\ProdutoController;
use App\Controllers\Pagamento\PagamentoController;
use App\Controllers\Cliente\ClienteController;
use App\Controllers\Grupo\GrupoController;
use App\Controllers\NotaFiscal\NotaFiscalController;
use App\Controllers\NotaFiscal\Entrada\EntradaController;
use App\Controllers\Tributacao\TributacaoController;
use App\Controllers\Fornecedor\FornecedorController;

$router = new Router();
$auth = new Auth();
$container = new Container();
$dependencyProvider = new DependencyProvider($container);
$dependencyProvider->register();

//containers creation 
$notFoundController = $container->get(NotFoundController::class);
$userController = $container->get(UserController::class);
$dashboardController = $container->get(DashboardController::class);
$permissaoController = $container->get(PermissaoController::class);
$permissaoUserController = $container->get(PermissaoUserController::class);
$userPerfilController = $container->get(UserPerfilController::class);
$recoveryPasswordController = $container->get(RecoveryPasswordController::class);
$vendaController = $container->get(VendaController::class);
$pdvController = $container->get(PdvController::class);
$produtoController = $container->get(ProdutoController::class);
$pagamentoController = $container->get(PagamentoController::class);
$clienteController = $container->get(ClienteController::class);
$grupoController = $container->get(GrupoController::class);
$notaFiscalController = $container->get(NotaFiscalController::class);
$entradaController = $container->get(EntradaController::class);
$tributacaoController = $container->get(TributacaoController::class);
$fornecedorController = $container->get(FornecedorController::class);

//rotas

//not-found
$router->create("GET", "/404", [$notFoundController, 'index']);

//login e logout
$router->create("GET", "/", [$userController, 'login'], null);
$router->create("POST", "/login", [$userController, 'auth'], null);
$router->create("GET", "/logout", [$userController, 'logout'], $auth);

//dashboard
$router->create("GET", "/dashboard", [$dashboardController, 'index'], $auth);

//usuarios
$router->create("GET", "/usuarios", [$userController, 'index'], $auth);
$router->create("GET", "/usuarios/cadastro", [$userController, 'create'], $auth);
$router->create("POST", "/usuarios/cadastro", [$userController, 'store'], $auth);
$router->create("GET", "/usuarios/{uuid}/editar", [$userController, 'edit'], $auth);
$router->create("POST", "/usuarios/{uuid}/editar", [$userController, 'update'], $auth);
$router->create("POST", "/usuarios/{uuid}/deletar", [$userController, 'destroy'], $auth);

//recuperar senha
$router->create("GET", "/recuperar-senha", [$recoveryPasswordController, 'index'], null);
$router->create("POST", "/recuperar-senha", [$recoveryPasswordController, 'sendCode'], null);
$router->create("GET", "/recuperar-senha/{uuid}", [$recoveryPasswordController, 'verifyCode'], null);
$router->create("POST", "/recuperar-senha/{uuid}", [$recoveryPasswordController, 'verifySendCode'], null);
$router->create("GET", "/recuperar-senha/{uuid}/trocar-senha", [$recoveryPasswordController, 'replacePassword'], null);
$router->create("POST", "/recuperar-senha/{uuid}/trocar-senha", [$recoveryPasswordController, 'updatePassword'], null);
$router->create("GET", "/recuperar-senha/{uuid}/cancelar", [$recoveryPasswordController, 'cancelCode'], null);

//permissoes
$router->create("GET", "/permissoes", [$permissaoController, 'index'], $auth);
$router->create("GET", "/permissoes/cadastro", [$permissaoController, 'create'], $auth);
$router->create("POST", "/permissoes/cadastro", [$permissaoController, 'store'], $auth);
$router->create("GET", "/permissoes/{uuid}/editar", [$permissaoController, 'edit'], $auth);
$router->create("POST", "/permissoes/{uuid}/editar", [$permissaoController, 'update'], $auth);
$router->create("POST", "/permissoes/{uuid}/deletar", [$permissaoController, 'destroy'], $auth);

//permissao_user
$router->create("GET", "/usuarios/{uuid}/permissoes", [$permissaoUserController, 'index'], $auth);
$router->create("POST", "/usuarios/{uuid}/vincular", [$permissaoUserController, 'create'], $auth);

//perfil usuario
$router->create("GET", "/perfil", [$userPerfilController, 'index'], $auth);
$router->create("POST", "/perfil/icone", [$userPerfilController, 'updateIcone'], $auth);
$router->create("POST", "/perfil/editar", [$userPerfilController, 'updateDados'], $auth);
$router->create("POST", "/perfil/senha", [$userPerfilController, 'updateSenha'], $auth);
$router->create("POST", "/perfil/deletar", [$userPerfilController, 'destroy'], $auth);

//vendas
$router->create("GET", "/vendas", [$vendaController, 'index'], $auth);
$router->create("GET", "/vendas/{uuid}/visualizar", [$vendaController, 'viewSaleInfos'], $auth);
$router->create("GET", "/vendas/{uuid}/comprovante", [$vendaController, 'viewProofSale'], $auth);
$router->create("POST", "/vendas/{uuid}/cancelar", [$vendaController, 'cancelSale'], $auth);

//venda_clientes
$router->create("GET", "/pdv/clientes", [$pdvController, 'allClients'], $auth);
$router->create("POST", "/pdv/{uuid}/vincular-cliente/{cliente_uuid}", [$pdvController, 'bindClientOnSale'], $auth);
$router->create("POST", "/pdv/{uuid}/desvincular-cliente/{cliente_uuid}", [$pdvController, 'deleteClientLink'], $auth);

//pdv
$router->create("GET", "/pdv", [$pdvController, 'index'], $auth);
$router->create("GET", "/pdv/{uuid}", [$pdvController, 'pdv'], $auth);
$router->create("GET", "/pdv/{uuid}/finalizar", [$pdvController, 'viewSaleInfos'], $auth);
$router->create("POST", "/pdv/{uuid}/finalizar", [$pdvController, 'finish'], $auth);
$router->create("POST", "/pdv/{uuid}/finalizar/troco", [$pdvController, 'subtractPaidValue'], $auth);
$router->create("POST", "/pdv/{uuid}/finalizar/pagamento", [$pdvController, 'findPaymentMethod'], $auth);
$router->create("POST", "/pdv/{uuid}/em-espera", [$pdvController, 'suspendSale'], $auth);
$router->create("POST", "/pdv/{uuid}/liberar", [$pdvController, 'releaseSale'], $auth);
$router->create("POST", "/pdv/{uuid}/cancelar", [$pdvController, 'removeAllProducts'], $auth);

//venda_produtos
$router->create("POST", "/pdv/{uuid}/adicionar", [$pdvController, 'addProductInSale'], $auth);
$router->create("POST", "/pdv/{uuid}/remover/{uuid_produto}", [$pdvController, 'removeProductInSale'], $auth);

//produtos
$router->create("GET", "/produtos", [$produtoController, 'index'], $auth);
$router->create("GET", "/produtos-api", [$produtoController, 'indexApi'], $auth);
$router->create("GET", "/produtos/cadastro", [$produtoController, 'create'], $auth);
$router->create("POST", "/produtos/cadastro", [$produtoController, 'store'], $auth);
$router->create("GET", "/produtos/{uuid}/editar", [$produtoController, 'edit'], $auth);
$router->create("POST", "/produtos/{uuid}/editar", [$produtoController, 'update'], $auth);
$router->create("POST", "/produtos/{uuid}/deletar", [$produtoController, 'destroy'], $auth);

//tributacao
$router->create("GET", "/tributacoes", [$tributacaoController, 'index'], $auth);
$router->create("POST", "/tributacoes/cadastro", [$tributacaoController, 'store'], $auth);
$router->create("POST", "/tributacoes/{uuid}/deletar", [$tributacaoController, 'destroy'], $auth);

//formas-de-pagamentos
$router->create("GET", "/pagamentos", [$pagamentoController, 'index'], $auth);
$router->create("GET", "/pagamentos/cadastro", [$pagamentoController, 'create'], $auth);
$router->create("POST", "/pagamentos/cadastro", [$pagamentoController, 'store'], $auth);
$router->create("GET", "/pagamentos/{uuid}/editar", [$pagamentoController, 'edit'], $auth);
$router->create("POST", "/pagamentos/{uuid}/editar", [$pagamentoController, 'update'], $auth);
$router->create("POST", "/pagamentos/{uuid}/deletar", [$pagamentoController, 'destroy'], $auth);

//clientes
$router->create("GET", "/clientes", [$clienteController, 'index'], $auth);
$router->create("GET", "/clientes/cadastro", [$clienteController, 'create'], $auth);
$router->create("POST", "/clientes/cadastro", [$clienteController, 'store'], $auth);
$router->create("GET", "/clientes/{uuid}/editar", [$clienteController, 'edit'], $auth);
$router->create("POST", "/clientes/{uuid}/editar", [$clienteController, 'update'], $auth);
$router->create("POST", "/clientes/{uuid}/deletar", [$clienteController, 'destroy'], $auth);

//grupo-produtos
$router->create("GET", "/grupos", [$grupoController, 'index'], $auth);
$router->create("GET", "/grupos/cadastro", [$grupoController, 'create'], $auth);
$router->create("POST", "/grupos/cadastro", [$grupoController, 'store'], $auth);
$router->create("GET", "/grupos/{uuid}/editar", [$grupoController, 'edit'], $auth);
$router->create("POST", "/grupos/{uuid}/editar", [$grupoController, 'update'], $auth);
$router->create("POST", "/grupos/{uuid}/deletar", [$grupoController, 'destroy'], $auth);

//fornecedores
$router->create("GET", "/fornecedores", [$fornecedorController, 'index'], $auth);
$router->create("GET", "/fornecedores/cadastro", [$fornecedorController, 'create'], $auth);
$router->create("POST", "/fornecedores/cadastro", [$fornecedorController, 'store'], $auth);
$router->create("GET", "/fornecedores/{uuid}/editar", [$fornecedorController, 'edit'], $auth);
$router->create("POST", "/fornecedores/{uuid}/editar", [$fornecedorController, 'update'], $auth);
$router->create("POST", "/fornecedores/{uuid}/deletar", [$fornecedorController, 'destroy'], $auth);

//nota-fiscal
$router->create("GET", "/gerar-xml", [$notaFiscalController, 'generateXml'], $auth);
$router->create("GET", "/transmitir-nfe", [$notaFiscalController, 'transmitNFe'], $auth);

//entrada
$router->create("GET", "/fiscal/entradas", [$entradaController, 'index'], $auth);
$router->create("GET", "/fiscal/entradas/cadastro", [$entradaController, 'create'], $auth);
$router->create("POST", "/fiscal/entradas/search", [$entradaController, 'searchNF'], $auth);
$router->create("POST", "/fiscal/entradas/cadastro", [$entradaController, 'store'], $auth);

return $router;