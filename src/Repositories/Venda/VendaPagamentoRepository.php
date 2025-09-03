<?php

namespace App\Repositories\Venda;

use App\Config\Database;
use App\Interfaces\Venda\IVendaPagamento;
use App\Models\Venda\VendaPagamento;
use App\Repositories\Traits\Find;

class VendaPagamentoRepository implements IVendaPagamento {

    const CLASS_NAME = VendaPagamento::class;
    const TABLE = 'venda_pagamento';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new VendaPagamento();
    }

    public function all(array $params = []){
        $sql = "SELECT vp.*, 
            p.forma as forma 
            FROM " .self::TABLE. " vp
            JOIN pagamento p
                ON pagamento_id = p.id
        ";

        $conditions = [];
        $bindings = [];
    
        if(isset($params['pagamento_id']) && $params['pagamento_id'] != ""){
            $conditions[] = "vp.pagamento_id = :pagamento_id";
            $bindings[':pagamento_id'] = $params['pagamento_id'];
        }

        if(isset($params['vendas_id']) && $params['vendas_id'] != ""){
            $conditions[] = "vp.vendas_id = :vendas_id";
            $bindings[':vendas_id'] = $params['vendas_id'];
        }
    
        if(count($conditions) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY created_at ASC";

        if(isset($params['dash']) && !empty($params['dash'])){
            $sql .= " LIMIT 20";
        };

        $stmt = $this->conn->prepare($sql);

        $stmt->execute($bindings);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::CLASS_NAME);
    }

    public function create(int $vendas_id, int $pagamento_id){
        $vendaPagamento = $this->model->create($vendas_id, $pagamento_id);

        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    vendas_id = :vendas_id,
                    pagamento_id = :pagamento_id
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $vendaPagamento->uuid,
                ':vendas_id' => $vendaPagamento->vendas_id,
                ':pagamento_id' => $vendaPagamento->pagamento_id
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($vendaPagamento->uuid);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function delete($vendas_id, $pagamento_id){
        $sql = "DELETE FROM " . self::TABLE . "
            WHERE
                vendas_id = :vendas_id
            AND
                pagamento_id = :pagamento_id
        ";

        $stmt = $this->conn->prepare($sql);

        $delete = $stmt->execute([
            ':vendas_id' => $vendas_id,
            ':pagamento_id' => $pagamento_id
        ]);

        return $delete;
    }

    public function findBySaleId(int $vendas_id){
        try{
            $sql = "SELECT * FROM " . self::TABLE . "
                WHERE
                    vendas_id = :vendas_id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':vendas_id' => $vendas_id]);

            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::CLASS_NAME);
            $result = $stmt->fetch();

            if(empty($result)){
                return null;
            }

            return $result;

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

}