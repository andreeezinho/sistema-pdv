<?php

namespace App\Models\Embalagem;

use App\Models\Traits\Uuid;

class Embalagem {

    use Uuid;

    public $id;
    public $uuid;
    public $quantidade;
    public $tipo;
    public $ativo;
    public $created_at;
    public $updated_at;

    public function create(array $data) : Embalagem {
        $embalagem = new Embalagem();
        $embalagem->id = $data['id'] ?? null;
        $embalagem->uuid = $data['uuid'] ?? $this->generateUUID() ?? null;
        $embalagem->quantidade = $data['quantidade'] ?? null;
        $embalagem->tipo = $data['tipo'] ?? null;
        $embalagem->ativo = $data['ativo'] ?? null;
        $embalagem->created_at = $data['created_at'] ?? null;
        $embalagem->updated_at = $data['updated_at'] ?? null;
        return $embalagem;
    }

}