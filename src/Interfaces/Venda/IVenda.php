<?php

namespace App\Interfaces\Venda;

interface IVenda {

    public function all(array $params = []);

    public function create(array $data, int $usuarios_id);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function findById(int $id);

    public function findByUuid(string $uuid);

}