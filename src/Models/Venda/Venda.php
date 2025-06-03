<?php

namespace App\Models\Venda;

use App\Models\Traits\Uuid;

class Venda {

    use Uuid;

    public $id;
    public $uuid;
    public $desconto;
    public $total;
    public $situacao;
    public $usuarios_id;
    public $usuario;
    public $cpf;
    public $created_at;
    public $updated_at;

    public function create(array $data, int $usuarios_id) : Venda {
        $venda = new Venda();
        $venda->id = $data['id'] ?? null;
        $venda->uuid = $data['uuid'] ?? $this->generateUUID();
        $venda->desconto = (!isset($data['desconto']) || $data['desconto'] == "") ? 0 : $data['desconto'];
        $venda->situacao = (!isset($data['situacao']) || $data['situacao'] == "") ? 'em andamento' : $data['situacao'];
        $venda->usuarios_id = $usuarios_id ?? null;
        $venda->created_at = $data['created_at'] ?? null;
        $venda->updated_at = $data['updated_at'] ?? null;
        return $venda;
    }

}