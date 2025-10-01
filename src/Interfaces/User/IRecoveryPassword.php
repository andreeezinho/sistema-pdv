<?php

namespace App\Interfaces\User;

interface IRecoveryPassword {

    public function create(int $usuarios_id, array $data = null);

    public function delete(int $id, int $usuarios_id);

    public function findByCodeAndUser(int $usuarios_id, int $code);

    public function findById(int $id);

    public function findByUuid(string $uuid);

}