<?php

namespace App\Models\Origem;

use App\Models\Traits\Uuid;

class Origem {

    use Uuid;

    public $id;
    public $uuid;
    public $codigo;
    public $nome;
    public $ativo;
    public $created_at;
    public $updated_at;

    public function create(array $data) : Origem {
        $origem = new Origem();
        $origem->id = $data['id'] ?? null;
        $origem->uuid = $data['uuid'] ?? $this->generateUUID() ?? null;
        $origem->codigo = $data['codigo'] ?? null;
        $origem->nome = $data['nome'] ?? null;
        $origem->ativo = $data['ativo'] ?? null;
        $origem->created_at = $data['created_at'] ?? null;
        $origem->updated_at = $data['updated_at'] ?? null;
        return $origem;
    }

}