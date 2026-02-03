<?php

namespace App\Repositories\Endereco;

use App\Config\Database;
use App\Interfaces\Endereco\IEndereco;
use App\Models\Endereco\Endereco;
use App\Repositories\Traits\Find;

class EnderecoRepository implements IEndereco {

    const CLASS_NAME = Endereco::class;
    const TABLE = 'enderecos';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new Endereco();
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
        $endereco = $this->model->create($data);
        
        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    cep = :cep,
                    uf = :uf,
                    codigo = :codigo,
                    ibge = :ibge,
                    cidade = :cidade,
                    rua = :rua,
                    bairro = :bairro,
                    numero = :numero,
                    complemento = :complemento,
                    ativo = :ativo
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $endereco->uuid,
                ':cep' => $endereco->cep,
                ':uf' => $endereco->uf,
                ':codigo' => $endereco->codigo,
                ':ibge' => $endereco->ibge,
                ':cidade' => $endereco->cidade,
                ':rua' => $endereco->rua,
                ':bairro' => $endereco->bairro,
                ':numero' => $endereco->numero,
                ':complemento' => $endereco->complemento,
                ':ativo' => $endereco->ativo ?? 1
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($endereco->uuid);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function update(array $data, int $id){
        $endereco = $this->model->create($data);

        try{
            $sql = "UPDATE " . self::TABLE . "
                SET
                    cep = :cep,
                    uf = :uf,
                    codigo = :codigo,
                    ibge = :ibge,
                    cidade = :cidade,
                    rua = :rua,
                    bairro = :bairro,
                    numero = :numero,
                    complemento = :complemento,
                    ativo = :ativo
                WHERE 
                    id =:id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':cep' => $endereco->cep,
                ':uf' => $endereco->uf,
                ':codigo' => $endereco->codigo,
                ':ibge' => $endereco->ibge,
                ':cidade' => $endereco->cidade,
                ':rua' => $endereco->rua,
                ':bairro' => $endereco->bairro,
                ':numero' => $endereco->numero,
                ':complemento' => $endereco->complemento,
                ':ativo' => $endereco->ativo,
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