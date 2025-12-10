<?php

namespace App\Models\Endereco;

use App\Models\Traits\Uuid;

class Endereco {

    use Uuid;

    public $id;
    public $uuid;
    public $cep;
    public $uf;
    public $codigo;
    public $ibge;
    public $cidade;
    public $rua;
    public $bairro;
    public $numero;
    public $complemento;
    public $ativo;
    public $created_at;
    public $updated_at;

    public function create(array $data) : Endereco {
        $endereco = new Endereco();
        $endereco->id = $data['id'] ?? null;
        $endereco->uuid = $data['uuid'] ?? $this->generateUUID();
        $endereco->cep = $data['cep'] ?? null;
        $endereco->uf = $data['uf'] ?? null;
        $endereco->codigo = $data['codigo'] ?? null;
        $endereco->ibge = $data['ibge'] ?? null;
        $endereco->cidade = $data['cidade'] ?? null;
        $endereco->rua = $data['rua'] ?? null;
        $endereco->bairro = $data['bairro'] ?? null;
        $endereco->numero = $data['numero'] ?? null;
        $endereco->complemento = $data['complemento'] ?? null;
        $endereco->ativo = (!isset($data['ativo']) || $data['ativo'] == "") ? 1 : $data['ativo'];
        $endereco->created_at = $data['created_at'] ?? null;
        $endereco->updated_at = $data['updated_at'] ?? null;
        return $endereco;
    }

}