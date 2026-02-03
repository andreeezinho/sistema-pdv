<?php

namespace App\Interfaces\Origem;

interface IOrigem {

    public function all(array $params = []);

    public function create(array $data);

    public function delete(int $id);

    public function findById(int $id);

    public function findByUuid(string $uuid);

}