<?php

namespace App\Models\Tributacao;

use App\Models\Traits\Uuid;

class Tributacao {

    use Uuid;

    public $id;
    public $uuid;
    public $nome;
    public $tributacao;
    public $ativo;
    public $created_at;
    public $updated_at;

    public function create(array $data) : Tributacao {
        $tributacao = new Tributacao();
        $tributacao->id = $data['id'] ?? null;
        $tributacao->uuid = $data['uuid'] ?? $this->generateUUID() ?? null;
        $tributacao->nome = $data['nome'] ?? null;
        $tributacao->tributacao = $data['tributacao'] ?? null;
        $tributacao->ativo = $data['ativo'] ?? null;
        $tributacao->created_at = $data['created_at'] ?? null;
        $tributacao->updated_at = $data['updated_at'] ?? null;
        return $tributacao;
    }

}