<?php

namespace App\Interfaces\Permissao;

interface IPermissaoUser {

    public function allUserPermissions(int $usuario_id);

    public function linkUserPermission($data, int $usuario_id);

    public function unlinkUserPermission(int $usuario_id);

    public function findById(int $id);

    public function findByUuid(string $uuid);

}