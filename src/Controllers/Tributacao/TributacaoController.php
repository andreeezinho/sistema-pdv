<?php

namespace App\Controllers\Tributacao;

use App\Controllers\Controller;
use App\Repositories\Tributacao\TributacaoRepository;
use App\Request\Request;


class TributacaoController extends Controller{

    protected $tributacaoRepository;

    public function __construct(TributacaoRepository $tributacaoRepository){
        parent::__construct();
        $this->tributacaoRepository = $tributacaoRepository;
    }

    public function index(Request $request){
        $icms = $this->tributacaoRepository->all('icms', ["ativo" => 1]);
        $ipi = $this->tributacaoRepository->all('ipi', ["ativo" => 1]);
        $pis = $this->tributacaoRepository->all('pis', ["ativo" => 1]);
        $cofins = $this->tributacaoRepository->all('cofins', ["ativo" => 1]);

        return $this->router->view('tributacao/index', [
            'icms' => $icms,
            'ipi' => $ipi,
            'pis' => $pis,
            'cofins' => $cofins,
        ]);
    }

    public function store(Request $request){
        $data = $request->getBodyParams();

        $create = $this->tributacaoRepository->create($data['tipo'], $data);

        if(is_null($create)){
            return $this->router->view('tributacao/index', [
                'erro' => 'Erro ao cadastrar tributação'
            ]);
        }

        return $this->router->redirect('tributacoes');
    }

}