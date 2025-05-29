<?php

namespace App\Models\User;

use App\Models\Traits\Uuid;

class RecoveryPassword {

    use Uuid;

    public $id;
    public $uuid;
    public $usuarios_id;
    public $codigo;
    public $created_at;
    public $updated_at;

    public function create(array $data = null, int $usuarios_id){
        $recuperar = new RecoveryPassword();
        $recuperar->id = $data['id'] ?? null;
        $recuperar->uuid = $data['uuid'] ?? $this->generateUUID();
        $recuperar->usuarios_id = $usuarios_id ?? null;
        $recuperar->codigo = $data['codigo'] ?? $this->generateCode();
        $recuperar->created_at = $data['created_at'] ?? null;
        $recuperar->updated_at = $data['updated_at'] ?? null;
        return $recuperar;
    }

}