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

        $faturamento = $this->vendaRepository->getInvoicing(['data' => date("Y-m-d"), 'situacao' => 'concluida']);

        $last_sales = $this->vendaRepository->all(['data' => date("Y-m-d"), 'situacao' => 'concluida', 'dash' => true]);

        $total_last_sales = $this->vendaRepository->getTotalLastSales(date("Y-m-d", strtotime('-2 day')));

        $daily_sales = [
            'hoje' => [
                'concluida' => $this->vendaRepository->getDailySales(['data' => date("Y-m-d"), 'situacao' => 'concluida']), 
                'cancelada' => $this->vendaRepository->getDailySales(['data' => date("Y-m-d"), 'situacao' => 'cancelada']), 
                'em espera' => $this->vendaRepository->getDailySales(['data' => date("Y-m-d"), 'situacao' => 'em espera']) 
            ],

            'ontem' => [
                'concluida' => $this->vendaRepository->getDailySales(['data' => date("Y-m-d", strtotime('-1 day')), 'situacao' => 'concluida']), 
                'cancelada' => $this->vendaRepository->getDailySales(['data' => date("Y-m-d", strtotime('-1 day')), 'situacao' => 'cancelada']), 
                'em espera' => $this->vendaRepository->getDailySales(['data' => date("Y-m-d", strtotime('-1 day')), 'situacao' => 'em espera']) 
            ],

            'anteontem' => [
                'concluida' => $this->vendaRepository->getDailySales(['data' => date("Y-m-d", strtotime('-2 day')), 'situacao' => 'concluida']), 
                'cancelada' => $this->vendaRepository->getDailySales(['data' => date("Y-m-d", strtotime('-2 day')), 'situacao' => 'cancelada']), 
                'em espera' => $this->vendaRepository->getDailySales(['data' => date("Y-m-d", strtotime('-2 day')), 'situacao' => 'em espera']) 
            ],
        ];

        $daily_invoice = [
            'hoje' => [
                'concluida' => $this->vendaRepository->getInvoicing(['data' => date("Y-m-d"), 'situacao' => 'concluida'])
            ],

            'ontem' => [
                'concluida' => $this->vendaRepository->getInvoicing(['data' => date("Y-m-d", strtotime('-1 day')), 'situacao' => 'concluida'])
            ],

            'anteontem' => [
                'concluida' => $this->vendaRepository->getInvoicing(['data' => date("Y-m-d", strtotime('-2 day')), 'situacao' => 'concluida'])
            ],

            '4' => [
                'concluida' => $this->vendaRepository->getInvoicing(['data' => date("Y-m-d", strtotime('-3 day')), 'situacao' => 'concluida'])
            ],

            '5' => [
                'concluida' => $this->vendaRepository->getInvoicing(['data' => date("Y-m-d", strtotime('-4 day')), 'situacao' => 'concluida'])
            ],
        ];

        $produtos = $this->produtoRepository->all();

        return $this->router->view('dashboard/index', [
            'user' => $user,
            'usuarios' => $usuarios,
            'vendas' => $vendas,
            'faturamento' => $faturamento,
            'produtos' => $produtos,
            'last_sales' => $last_sales,
            'total_last_sales' => $total_last_sales,
            'daily_sales' => $daily_sales,
            'daily_invoice' => $daily_invoice
        ]);
    }

}