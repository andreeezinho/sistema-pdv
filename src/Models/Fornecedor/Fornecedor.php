<?php

namespace App\Models\Fornecedor;

use App\Models\Traits\Uuid;

class Fornecedor {

    use Uuid;

    public $id;
    public $uuid;
    public $razao_social;
    public $nome_fantasia;
    public $documento;
    public $ie_rg;
    public $num_serie_nfe;
    public $enderecos_id;
    public $ativo;
    public $created_at;
    public $updated_at;

    public function create(array $data) : Fornecedor {
        $fornecedor = new Fornecedor();
        $fornecedor->id = $data['id'] ?? null;
        $fornecedor->uuid = $data['uuid'] ?? $this->generateUUID();
        $fornecedor->razao_social = $data['razao_social'] ?? null;
        $fornecedor->nome_fantasia = $data['nome_fantasia'] ?? null;
        $fornecedor->documento = $data['documento'] ?? null;
        $fornecedor->ie_rg = $data['ie_rg'] ?? null;
        $fornecedor->num_serie_nfe = $data['num_serie_nfe'] ?? null;
        $fornecedor->enderecos_id = $data['enderecos_id'] ?? null;
        $fornecedor->ativo = (!isset($data['ativo']) || $data['ativo'] == "") ? 1 : $data['ativo'];
        $fornecedor->created_at = $data['created_at'] ?? null;
        $fornecedor->updated_at = $data['updated_at'] ?? null;
        return $fornecedor;
    }
}