<?php

namespace App\Interfaces\Produto;

interface IProduto {

    public function all(array $params = []);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function subtractProduct(int $id, int $quantity);

    public function verifyProductQuantity(array $all_products, array $vendaProdutos);

    public function findByCode(int $codigo);

    public function findById(int $id);

    public function findByUuid(string $uuid);

}