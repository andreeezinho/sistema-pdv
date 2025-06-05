<?php

namespace App\Repositories\Venda;

use App\Config\Database;
use App\Interfaces\Venda\IVendaProduto;
use App\Models\Venda\VendaProduto;
use App\Repositories\Traits\Find;

class VendaProdutoRepository implements IVendaProduto {

    const CLASS_NAME = VendaProduto::class;
    const TABLE = 'venda_produto';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new VendaProduto();
    }

    public function allProductsOnSale(int $vendas_id){
        $sql = "SELECT vp.*,
			           v.id as venda,
            p.nome as nome, p.codigo as codigo, p.preco as preco, p.uuid as uuidProduto
            FROM " . self::TABLE . " vp
            JOIN vendas v
                ON vendas_id = v.id
            JOIN produtos p
                ON produtos_id = p.id
            WHERE
                v.id = :vendas_id
            ORDER BY 
                vp.created_at ASC
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':vendas_id' => $vendas_id
        ]);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::CLASS_NAME);
    }

    public function create(array $data, int $vendas_id, int $produtos_id){
        $vendaProduto = $this->model->create($data, $vendas_id, $produtos_id);

        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    quantidade = :quantidade,
                    vendas_id = :vendas_id,
                    produtos_id = :produtos_id
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $vendaProduto->uuid,
                ':quantidade' => $vendaProduto->quantidade,
                ':vendas_id' => $vendaProduto->vendas_id,
                ':produtos_id' => $vendaProduto->produtos_id
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($vendaProduto->uuid);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function updateQuantity(float $quantity, int $id){}

    public function delete(int $id, $vendas_id, $produtos_id){
        $sql = "DELETE FROM " . self::TABLE . "
            WHERE
                id = :id
            AND
                vendas_id = :vendas_id
            AND
                produtos_id = :produtos_id
        ";

        $stmt = $this->conn->prepare($sql);

        $delete = $stmt->execute([
            ':id' => $id,
            ':vendas_id' => $vendas_id,
            ':produtos_id' => $produtos_id
        ]);

        return $delete;
    }

    public function deleteAllProductsInSale(int $vendas_id){
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

}