<?php

namespace App\Models\Produto;

use App\Models\Traits\Uuid;

class Produto {

    use Uuid;

    public $id;
    public $uuid;
    public $nome;
    public $codigo;
    public $preco;
    public $estoque;
    public $tipo;
    public $grupo_produto_id;
    public $entrada_produto_id;
    public $saida_produto_id;
    public $icms_id;
    public $ipi_id;
    public $pis_id;
    public $cofins_id;
    public $origem_id;
    public $cfop;
    public $ncm;
    public $cest;
    public $nat_receita;
    public $nome_grupo;
    public $ativo;
    public $created_at;
    public $updated_at;

    public function create(array $data) : Produto {
        $produto = new Produto();
        $produto->id = $data['id'] ?? null;
        $produto->uuid = $data['uuid'] ?? $this->generateUUID();
        $produto->nome = $data['nome'] ?? null;
        $produto->codigo = $data['codigo'] ?? null;
        $produto->preco = $data['preco'] ?? null;
        $produto->estoque = $data['estoque'] ?? null;
        $produto->tipo = $data['tipo'] ?? null;
        $produto->grupo_produto_id = $data['grupo_produto_id'] ?? null;
        $produto->ativo = (!isset($data['ativo']) || $data['ativo'] == "") ? 1 : $data['ativo'];
        $produto->created_at = $data['created_at'] ?? null;
        $produto->updated_at = $data['updated_at'] ?? null;
        return $produto;
    }

}