<?php

namespace App\Models\Venda;

use App\Models\Traits\Uuid;

class VendaPagamento {

    use Uuid;

    public $id;
    public $uuid;
    public $forma;
    public $pagamento_id;
    public $vendas_id;
    public $created_at;
    public $updated_at;

    public function create(int $vendas_id, int $pagamento_id) : VendaPagamento {
        $vendaProduto = new VendaPagamento();
        $vendaProduto->id = $data['id'] ?? null;
        $vendaProduto->uuid = $data['uuid'] ?? $this->generateUUID();
        $vendaProduto->pagamento_id = $pagamento_id ?? null;
        $vendaProduto->vendas_id = $vendas_id ?? null;
        $vendaProduto->created_at = $data['created_at'] ?? null;
        $vendaProduto->updated_at = $data['updated_at'] ?? null;
        return $vendaProduto;
    }

}