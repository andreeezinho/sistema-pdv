<?php

namespace App\Models\Venda;

use App\Models\Traits\Uuid;

class VendaProduto {

    use Uuid;

    public $id;
    public $uuid;
    public $quantidade;
    public $nome;
    public $codigo;
    public $tipo;
    public $preco;
    public $uuidProduto;
    public $produtos_id;
    public $vendas_id;
    public $venda;
    public $created_at;
    public $updated_at;

    public function create(array $data, int $vendas_id, int $produtos_id) : VendaProduto {
        $vendaProduto = new VendaProduto();
        $vendaProduto->id = $data['id'] ?? null;
        $vendaProduto->uuid = $data['uuid'] ?? $this->generateUUID();
        $vendaProduto->quantidade = (!isset($data['quantidade']) || $data['quantidade'] == "") ? 1 : $data['quantidade'];
        $vendaProduto->produtos_id = $produtos_id ?? null;
        $vendaProduto->vendas_id = $vendas_id ?? null;
        $vendaProduto->created_at = $data['created_at'] ?? null;
        $vendaProduto->updated_at = $data['updated_at'] ?? null;
        return $vendaProduto;
    }

}