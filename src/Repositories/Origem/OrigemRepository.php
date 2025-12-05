<?php

namespace App\Repositories\Origem;

use App\Config\Database;
use App\Interfaces\Origem\IOrigem;
use App\Models\Origem\Origem;
use App\Repositories\Traits\Find;

class OrigemRepository implements IOrigem {

    const CLASS_NAME = Origem::class;
    const TABLE = 'origem';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new Origem();
    }

    public function all(array $params = []){
        $sql = "SELECT * FROM " . self::TABLE;

        $conditions = [];
        $bindings = [];

        if(isset($params['codigo']) && $params['codigo'] != ""){
            $conditions[] = "codigo = :codigo";
            $bindings[':codigo'] = $params['codigo'];
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
        $origem = $this->model->create($data);

        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    codigo = :codigo,
                    nome = :nome,
                    ativo = :ativo
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $origem->uuid,
                ':codigo' => $origem->codigo,
                ':nome' => $origem->nome,
                ':ativo' => $origem->ativo ?? 1
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($origem->uuid);

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