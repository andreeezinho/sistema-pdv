<?php

namespace App\Controllers\Fornecedor;

use App\Controllers\Controller;
use App\Request\Request;
use App\Interfaces\Fornecedor\IFornecedor;

class FornecedorController extends Controller {

    protected $fornecedorRepository;

    public function __construct(IFornecedor $fornecedorRepository){
        parent::__construct();
        $this->fornecedorRepository = $fornecedorRepository;
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

        $create = $this->fornecedorRepository->create($data);

        if(is_null($create)){
            return $this->router->view('fornecedor/create', [
                'erro' => 'Não foi possível cadastrar fornecedor'
            ]);
        }

        return $this->router->redirect('fornecedores');
    }

    public function edit(Request $request, $uuid){}

    public function update(Request $request, $uuid){}

    public function destroy(Request $request, $uuid){}
    

}
