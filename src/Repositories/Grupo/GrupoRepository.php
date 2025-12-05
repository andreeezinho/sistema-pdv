<?php

namespace App\Repositories\Grupo;

use App\Config\Database;
use App\Interfaces\Grupo\IGrupo;
use App\Models\Grupo\Grupo;
use App\Repositories\Traits\Find;

class GrupoRepository implements IGrupo {

    const CLASS_NAME = Grupo::class;
    const TABLE = 'grupo_produto';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new Grupo();
    }

    public function all(array $params = []){
        $sql = "SELECT * FROM " . self::TABLE;
    
        $conditions = [];
        $bindings = [];
    
        if(isset($params['nome']) && !empty($params['nome'])){
            $conditions[] = "nome LIKE :nome";
            $bindings[':nome'] = "%" . $params['nome'] . "%" ;
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
        $grupo = $this->model->create($data);
        
        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    nome = :nome,
                    ativo = :ativo
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $grupo->uuid,
                ':nome' => $grupo->nome,
                ':ativo' => $grupo->ativo ?? 1
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($grupo->uuid);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function update(array $data, int $id){
        $grupo = $this->model->create($data);

        try{
            $sql = "UPDATE " . self::TABLE . "
                SET
                    nome = :nome,
                    ativo = :ativo
                WHERE 
                    id =:id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':nome' => $grupo->nome,
                ':ativo' => $grupo->ativo,
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