<?php

namespace App\Controllers\Cliente;

use App\Request\Request;
use App\Controllers\Controller;
use App\Interfaces\Cliente\ICliente;

class ClienteController extends Controller {

    protected $clienteRepository;

    public function __construct(ICliente $clienteRepository){
        parent::__construct();
        $this->clienteRepository = $clienteRepository;
    }

    public function index(Request $request){
        $params = $request->getQueryParams();

        $clientes = $this->clienteRepository->all($params);

        return $this->router->view('cliente/index', [
            'clientes' => $clientes,
            'nome' => $params['nome'] ?? null,
            'documento' => $params['documento'] ?? null,
            'ativo' => $params['ativo'] ?? null
        ]);
    }

    public function create(Request $request){
        return $this->router->view('cliente/create', []);
    }

    public function store(Request $request){
        $data = $request->getBodyParams();

        $create = $this->clienteRepository->create($data);

        if(is_null($create)){
            return $this->router->view('cliente/create', [
                'erro' => 'Erro ao cadastrar cliente'
            ]);
        }

        return $this->router->redirect('clientes');
    }

    public function edit(Request $request, $uuid){
        $cliente = $this->clienteRepository->findByUuid($uuid);

        if(!$cliente){
            return $this->router->redirect('404');
        }

        return $this->router->view('cliente/edit', [
            'cliente' => $cliente
        ]);
    }

    public function update(Request $request, $uuid){
        $cliente = $this->clienteRepository->findByUuid($uuid);

        if(!$cliente){
            return $this->router->redirect('clientes');
        }

        $data = $request->getBodyParams();

        $update = $this->clienteRepository->update($data, $cliente->id);

        if(is_null($update)){
            return $this->router->view('cliente/create', [
                'erro' => 'Erro ao cadastrar cliente',
                'cliente' => $cliente
            ]);
        }

        return $this->router->redirect('clientes');
    }

    public function destroy(Request $request, $uuid){
        $cliente = $this->clienteRepository->findByUuid($uuid);

        if(!$cliente){
            return $this->router->redirect('clientes');
        }

        $delete = $this->clienteRepository->delete($cliente->id);

        if(!$delete){
            return $this->router->redirect('404');
        }

        return $this->router->redirect('clientes');
    }

}