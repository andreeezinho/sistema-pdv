<?php

namespace App\Models\Pagamento;

use App\Models\Traits\Uuid;

class Pagamento {

    use Uuid;

    public $id;
    public $uuid;
    public $forma;
    public $ativo;
    public $created_at;
    public $updated_at;

    public function create(array $data) : Pagamento {
        $pagamento = new Pagamento();
        $pagamento->id = $data['id'] ?? null;
        $pagamento->uuid = $data['uuid'] ?? $this->generateUUID();
        $pagamento->forma = $data['forma'] ?? null;
        $pagamento->ativo = (!isset($data['ativo']) || $data['ativo'] == "") ? 1 : $data['ativo'];
        $pagamento->created_at = $data['created_at'] ?? null;
        $pagamento->updated_at = $data['updated_at'] ?? null;
        return $pagamento;
    }

}