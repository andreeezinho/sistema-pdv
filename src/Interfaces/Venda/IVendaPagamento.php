<?php

namespace App\Interfaces\Venda;

interface IVendaPagamento {

    public function create(int $vendas_id, int $pagamento_id);

    public function delete($vendas_id, $pagamento_id);

    public function findBySaleId(int $vendas_id);
    
    public function findById(int $id);

    public function findByUuid(string $uuid);

}