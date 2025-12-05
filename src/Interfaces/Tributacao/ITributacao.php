<?php

namespace App\Interfaces\Tributacao;

interface ITributacao {

    public function all(string $type, array $params = []);

    public function create(string $type, array $data);

    public function delete(string $type, int $id);

    public function findById(string $type, int $id);

    public function findByUuid(string $type, string $uuid);

}