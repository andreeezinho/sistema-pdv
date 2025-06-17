<?php

namespace App\Controllers\Pagamento;

use App\Request\Request;
use App\Controllers\Controller;
use App\Interfaces\Pagamento\IPagamento;

class PagamentoController extends Controller {

    protected $pagamentoRepository;

    public function __construct(IPagamento $pagamentoRepository){
        parent::__construct();
        $this->pagamentoRepository = $pagamentoRepository;
    }

    public function index(Request $request){
        $params = $request->getQueryParams();

        $pagamentos = $this->pagamentoRepository->all($params);

        return $this->router->view('pagamento/index', [
            'pagamentos' => $pagamentos,
            'forma' => $params['forma'] ?? null,
            'ativo' => $params['ativo'] ?? null
        ]);
    }

    public function create(Request $request){
        return $this->router->view('pagamento/create', []);
    }

    public function store(Request $request){
        $data = $request->getBodyParams();

        $create = $this->pagamentoRepository->create($data);

        if(is_null($create)){
            return $this->router->view('pagamento/index', [
                'erro' => 'Não foi possível cadastrar a forma de pagamento'
            ]);
        }

        return $this->router->redirect('pagamentos');
    }

    public function edit(Request $request, $uuid){
        $pagamento = $this->pagamentoRepository->findByUuid($uuid);

        if(!$pagamento){
            return $this->router->redirect('404');
        }

        return $this->router->view('pagamento/edit', [
            'pagamento' => $pagamento
        ]);
    }

    public function update(Request $request, $uuid){
        $pagamento = $this->pagamentoRepository->findByUuid($uuid);

        if(!$pagamento){
            return $this->router->redirect('404');
        }

        $data = $request->getBodyParams();
        
        $update = $this->pagamentoRepository->update($data, $pagamento->id);
        
        if(is_null($update)){
            return $this->router->view('pagamento/edit', [
                'pagamento' => $pagamento,
                'erro' => 'Erro ao editar forma de pagamento'
            ]);
        }

        return $this->router->redirect('pagamentos');
    }

    public function destroy(Request $request, $uuid){
        $pagamento = $this->pagamentoRepository->findByUuid($uuid);

        if(!$pagamento){
            return $this->router->redirect('404');
        }

        $delete = $this->pagamentoRepository->delete($pagamento->id);

        if(!$delete){
            return $this->router->redirect('pagamentos');
        }

        return $this->router->redirect('pagamentos');
    }

}