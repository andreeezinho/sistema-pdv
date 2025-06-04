<?php

namespace App\Interfaces\Venda;

interface IVendaProduto {

    public function allProductsOnSale(int $vendas_id);

    public function create(array $data, int $vendas_id, int $produtos_id);

    public function updateQuantity(float $quantity, int $id);

    public function delete(int $id, $vendas_id, $produtos_id);

    public function findByUserId(int $id);
    
    public function findById(int $id);

    public function findByUuid(string $uuid);

}