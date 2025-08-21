<?php

namespace App\Models\Venda;

use App\Models\Traits\Uuid;

class VendaCliente {

    use Uuid;

    public $id;
    public $uuid;
    public $nome;
    public $cliente;
    public $clientes_id;
    public $venda;
    public $vendas_id;
    public $created_at;
    public $updated_at;

    public function create(array $data, int $vendas_id, int $clientes_id) : VendaCliente {
        $vendaCliente = new VendaCliente();
        $vendaCliente->id = $data['id'] ?? null;
        $vendaCliente->uuid = $data['uuid'] ?? $this->generateUUID();
        $vendaCliente->clientes_id = $clientes_id ?? null;
        $vendaCliente->vendas_id = $vendas_id ?? null;
        $vendaCliente->created_at = $data['created_at'] ?? null;
        $vendaCliente->updated_at = $data['updated_at'] ?? null;
        return $vendaCliente;
    }

}