<?php

namespace App\Repositories\Venda;

use App\Config\Database;
use App\Interfaces\Venda\IVendaCliente;
use App\Models\Venda\VendaCliente;
use App\Repositories\Traits\Find;

class VendaClienteRepository implements IVendaCliente {

    const CLASS_NAME = VendaCliente::class;
    const TABLE = 'venda_cliente';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new VendaCliente();
    }

    public function allClientSale(int $clientes_id){
        $sql = "SELECT vc.*,
			           v.id as venda,
            c.id as cliente, c.nome as nome, c.documento as doc
            FROM " . self::TABLE . " vc
            JOIN vendas v
                ON vendas_id = v.id
            JOIN clientes c
                ON clientes_id = c.id
            WHERE
                c.id = :clientes_id
            ORDER BY 
                vc.created_at ASC
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':clientes_id' => $clientes_id
        ]);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::CLASS_NAME);
    }

    public function create(array $data, int $vendas_id, int $clientes_id){
        $vendaCliente = $this->model->create($data, $vendas_id, $clientes_id);

        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    vendas_id = :vendas_id,
                    clientes_id = :clientes_id
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $vendaCliente->uuid,
                ':vendas_id' => $vendaCliente->vendas_id,
                ':clientes_id' => $vendaCliente->clientes_id
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($vendaCliente->uuid);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function delete($vendas_id){
        $sql = "DELETE FROM " . self::TABLE . "
            WHERE
                vendas_id = :vendas_id
        ";

        $stmt = $this->conn->prepare($sql);

        $delete = $stmt->execute([
            ':vendas_id' => $vendas_id
        ]);

        return $delete;
    }

    public function findBySaleId($vendas_id){
        $stmt = $this->conn->prepare(
            "SELECT * FROM " . self::TABLE . " WHERE vendas_id = :vendas_id"
        );

        $stmt->bindParam(':vendas_id', $vendas_id, \PDO::PARAM_INT);
        $stmt->execute();

        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::CLASS_NAME);
        $result = $stmt->fetch();

        if(is_null($result)){
            return null;
        }

        return $result;
    }

}