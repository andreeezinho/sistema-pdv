<?php

namespace App\Models\Grupo;

use App\Models\Traits\Uuid;

class Grupo {

    use Uuid;

    public $id;
    public $uuid;
    public $nome;
    public $ativo;
    public $created_at;
    public $updated_at;

    public function create(array $data) : Grupo {
        $grupo = new Grupo();
        $grupo->id = $data['id'] ?? null;
        $grupo->uuid = $data['uuid'] ?? $this->generateUUID();
        $grupo->nome = $data['nome'] ?? null;
        $grupo->ativo = (!isset($data['ativo']) || $data['ativo'] == "") ? 1 : $data['ativo'];
        $grupo->created_at = $data['created_at'] ?? null;
        $grupo->updated_at = $data['updated_at'] ?? null;
        return $grupo;
    }

}