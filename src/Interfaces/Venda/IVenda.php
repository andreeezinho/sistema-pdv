<?php

namespace App\Interfaces\Venda;

interface IVenda {

    public function all(array $params = []);

    public function create(array $data, int $usuarios_id);

    public function update(array $data, int $id);

    public function updateSituation(string $situation, int $id);

    public function delete(int $id);

    public function findByLastUserSale(int $usuarios_id);

    public function getTotalLastSales(string $date);

    public function getDailySales(array $params);

    public function getInvoicing(array $params);

    public function updateDate(string $date, int $id);

    public function findById(int $id);

    public function findByUuid(string $uuid);

}