<?php

namespace App\Controllers\Fornecedor;

use App\Controllers\Controller;
use App\Request\Request;
use App\Interfaces\Fornecedor\IFornecedor;
use App\Interfaces\Endereco\IEndereco;

class FornecedorController extends Controller {

    protected $fornecedorRepository;
    protected $enderecoRepository;

    public function __construct(IFornecedor $fornecedorRepository, IEndereco $enderecoRepository){
        parent::__construct();
        $this->fornecedorRepository = $fornecedorRepository;
        $this->enderecoRepository = $enderecoRepository;
    }

    public function index(Request $request){
        $params = $request->getQueryParams();

        $fornecedores = $this->fornecedorRepository->all($params);

        return $this->router->view('fornecedor/index', [
            'fornecedores' => $fornecedores,
            'nome_razao' => $params['nome_razao'] ?? null,
            'ativo' => $params['ativo'] ?? null
        ]);
    }

    public function create(Request $request){
        return $this->router->view('fornecedor/create', []);
    }

    public function store(Request $request){
        $data = $request->getBodyParams();

        $endereco = $this->enderecoRepository->create($data);
        
        if(is_null($endereco)){
            return $this->router->view('fornecedor/create', [
                'erro' => 'Não foi possível inserir o endereço'
            ]);
        }

        $data = array_merge($data, ['enderecos_id' => $endereco->id]);

        $create = $this->fornecedorRepository->create($data);
        
        if(is_null($create)){
            return $this->router->view('fornecedor/create', [
                'erro' => 'Não foi possível cadastrar fornecedor'
            ]);
        }

        return $this->router->redirect('fornecedores');
    }

    public function edit(Request $request, $uuid){
        $fornecedor = $this->fornecedorRepository->findByUuid($uuid);

        if(!$fornecedor){
            return $this->router->redirect('404');
        }

        $endereco = $this->enderecoRepository->findById($fornecedor->enderecos_id);

        if(!$endereco){
            return $this->router->redirect('404');
        }

        return $this->router->view('fornecedor/edit', [
            'fornecedor' => $fornecedor,
            'endereco' => $endereco
        ]);
    }

    public function update(Request $request, $uuid){
        $fornecedor = $this->fornecedorRepository->findByUuid($uuid);

        if(!$fornecedor){
            return $this->router->redirect('404');
        }

        $endereco = $this->enderecoRepository->findById($fornecedor->enderecos_id);

        if(!$endereco){
            return $this->router->redirect('404');
        }

        $data = $request->getBodyParams();

        $update = $this->fornecedorRepository->update($data, $fornecedor->id);

        if(is_null($update)){
            return $this->router->view('fornecedor/edit', [
                'fornecedor' => $fornecedor,
                'endereco' => $endereco,
                'erro' => 'Erro ao atualizar fornecedor'
            ]);
        }

        $update_endereco = $this->fornecedorRepository->update($data, $fornecedor->id);

        if(is_null($update_endereco)){
            return $this->router->view('fornecedor/edit', [
                'fornecedor' => $fornecedor,
                'endereco' => $endereco,
                'erro' => 'Erro ao atualizar endereço'
            ]);
        }

        return $this->router->redirect('fornecedores');
    }

    public function destroy(Request $request, $uuid){
        $fornecedor = $this->fornecedorRepository->findByUuid($uuid);

        if(!$fornecedor){
            return $this->router->redirect('404');
        }

        $delete = $this->fornecedorRepository->delete($fornecedor->id);

        if(!$delete){
            return $this->router->redirect('fornecedores');
        }

        return $this->router->redirect('fornecedores');
    }
    

}
