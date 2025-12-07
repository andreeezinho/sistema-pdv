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

    public function index(Request $request){}

    public function create(Request $request){}

    public function store(Request $request){}

    public function edit(Request $request, $uuid){}

    public function update(Request $request, $uuid){}

    public function destroy(Request $request, $uuid){}
    

}
