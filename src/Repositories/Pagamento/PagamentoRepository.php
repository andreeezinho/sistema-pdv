<?php

namespace App\Repositories\Pagamento;

use App\Config\Database;
use App\Interfaces\Pagamento\IPagamento;
use App\Models\Pagamento\Pagamento;
use App\Repositories\Traits\Find;

class PagamentoRepository implements IPagamento {

    const CLASS_NAME = Pagamento::class;
    const TABLE = 'pagamento';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new Pagamento();
    }

    public function all(array $params = []){
        $sql = "SELECT * FROM " . self::TABLE;
    
        $conditions = [];
        $bindings = [];
    
        if(isset($params['forma']) && !empty($params['forma'])){
            $conditions[] = "forma LIKE :forma";
            $bindings[':forma'] = "%" . $params['forma'] . "%" ;
        }
    
        if(isset($params['ativo']) && $params['ativo'] != ""){
            $conditions[] = "ativo = :ativo";
            $bindings[':ativo'] = $params['ativo'];
        }
    
        if(count($conditions) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY id ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute($bindings);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::CLASS_NAME);
    }

    public function create(array $data){
        $pagamento = $this->model->create($data);
        
        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    forma = :forma,
                    ativo = :ativo
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $pagamento->uuid,
                ':forma' => $pagamento->forma,
                ':ativo' => $pagamento->ativo ?? 1
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($pagamento->uuid);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function update(array $data, int $id){
        $pagamento = $this->model->create($data);

        try{
            $sql = "UPDATE " . self::TABLE . "
                SET
                    forma = :forma,
                    ativo = :ativo
                WHERE 
                    id =:id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':forma' => $pagamento->forma,
                ':ativo' => $pagamento->ativo,
                ':id' => $id
            ]);

            if(!$update){
                return null;
            }

            return $this->findById($id);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function delete(int $id){
        try{
            $sql = "UPDATE " . self::TABLE . "
                SET
                    ativo = 0
                WHERE 
                    id =:id
            ";

            $stmt = $this->conn->prepare($sql);

            $delete = $stmt->execute([
                ':id' => $id
            ]);

            return $delete;

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

}