<?php

namespace App\Repositories\Venda;

use App\Config\Database;
use App\Interfaces\Venda\IVenda;
use App\Models\Venda\Venda;
use App\Repositories\Traits\Find;

class VendaRepository implements IVenda {

    const CLASS_NAME = Venda::class;
    const TABLE = 'vendas';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new Venda();
    }

    public function all(array $params = []){
        $sql = "SELECT v.*, 
            u.usuario as usuario, u.cpf as cpf 
            FROM " .self::TABLE. " v
            JOIN usuarios u
                ON usuarios_id = u.id
        ";
    
        $conditions = [];
        $bindings = [];
    
        if(isset($params['situacao']) && $params['situacao'] != ""){
            $conditions[] = "v.situacao = :situacao";
            $bindings[':situacao'] = $params['situacao'];
        }

        if(isset($params['usuario']) && !empty($params['usuario'])){
            $conditions[] = "u.usuario LIKE :usuario OR u.cpf LIKE :usuario";
            $bindings[':usuario'] = "%" . $params['usuario'] . "%";
        }

        if(isset($params['data']) && !empty($params['data'])){
            $conditions[] = "date_format(v.created_at, '%d/%m/%Y') <= date_format(:data, '%d/%m/%Y')";
            $bindings[':data'] = $params['data'];
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

    public function create(array $data, int $usuarios_id){
        $venda = $this->model->create($data, $usuarios_id);

        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    desconto = :desconto,
                    total = :total,
                    troco = :troco,
                    situacao = :situacao,
                    usuarios_id = :usuarios_id
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $venda->uuid,
                ':desconto' => $venda->desconto,
                ':total' => $venda->total,
                ':troco' => $venda->troco,
                ':situacao' => $venda->situacao,
                ':usuarios_id' => $venda->usuarios_id
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($venda->uuid);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function update(array $data, int $id){
        $venda = $this->model->create($data);

        try{
            $sql = "UPDATE " . self::TABLE . "
                SET
                    desconto = :desconto,
                    total = :total,
                    troco = :troco,
                    situacao = :situacao
                WHERE
                    id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':desconto' => $venda->desconto,
                ':total' => $venda->total,
                ':troco' => $venda->troco,
                ':situacao' => $venda->situacao,
                ':id' => $id
            ]);

            if(!$update){
                return null;
            }

            return $this->findById($id);

        }catch(\Throwable $th){
            return $th;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function finishSale(int $id){
        try{
            $sql = "UPDATE " . self::TABLE . "
                SET
                    situacao = :situacao
                WHERE
                    id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':situacao' => 'concluida',
                ':id' => $id
            ]);

            if(!$update){
                return null;
            }

            return $this->findById($id);

        }catch(\Throwable $th){
            return $th;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function delete(int $id){

    }

    public function findByLastUserSale(int $usuarios_id){
        try{
            $sql = "SELECT * FROM " . self::TABLE . "
                WHERE 
                    updated_at <= NOW() 
                AND 
                    situacao = 'em andamento'
                AND
                    usuarios_id = :usuarios_id
                ORDER BY 
                    updated_at DESC 
                LIMIT 1
                ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':usuarios_id' => $usuarios_id]);

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