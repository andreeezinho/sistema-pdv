<?php

namespace App\Controllers\Grupo;

use App\Request\Request;
use App\Controllers\Controller;
use App\Interfaces\Grupo\IGrupo;

class GrupoController extends Controller {

    protected $grupoRepository;

    public function __construct(IGrupo $grupoRepository){
        parent::__construct();
        $this->grupoRepository = $grupoRepository;
    }

    public function index(Request $request){
        $params = $request->getQueryParams();

        $grupos = $this->grupoRepository->all($params);

        return $this->router->view('grupo/index', [
            'grupos' => $grupos,
            'nome' => $params['nome'] ?? null,
            'ativo' => $params['ativo'] ?? null
        ]);
    }

    public function create(Request $request){
        return $this->router->view('grupo/create', []);
    }

    public function store(Request $request){
        $data = $request->getBodyParams();

        $create = $this->grupoRepository->create($data);

        if(is_null($create)){
            return $this->router->view('grupo/index', [
                'erro' => 'Não foi possível cadastrar o grupo'
            ]);
        }

        return $this->router->redirect('grupos');
    }

    public function edit(Request $request, $uuid){
        $grupo = $this->grupoRepository->findByUuid($uuid);

        if(!$grupo){
            return $this->router->redirect('404');
        }

        return $this->router->view('grupo/edit', [
            'grupo' => $grupo
        ]);
    }

    public function update(Request $request, $uuid){
        $grupo = $this->grupoRepository->findByUuid($uuid);

        if(!$grupo){
            return $this->router->redirect('404');
        }

        $data = $request->getBodyParams();
        
        $update = $this->grupoRepository->update($data, $grupo->id);
        
        if(is_null($update)){
            return $this->router->view('grupo/edit', [
                'grupo' => $grupo,
                'erro' => 'Erro o grupo do produto'
            ]);
        }

        return $this->router->redirect('grupos');
    }

    public function destroy(Request $request, $uuid){
        $grupo = $this->grupoRepository->findByUuid($uuid);

        if(!$grupo){
            return $this->router->redirect('404');
        }

        $delete = $this->grupoRepository->delete($grupo->id);

        if(!$delete){
            return $this->router->redirect('grupos');
        }

        return $this->router->redirect('grupos');
    }

}