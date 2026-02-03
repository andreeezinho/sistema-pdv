<?php

namespace App\Interfaces\Venda;

interface IVendaCliente {

    public function allClientSale(int $clientes_id);

    public function create(array $data, int $vendas_id, int $clientes_id);

    public function delete(int $vendas_id);
    
    public function findBySaleId(int $vendas_id);

    public function findById(int $id);

    public function findByUuid(string $uuid);

}