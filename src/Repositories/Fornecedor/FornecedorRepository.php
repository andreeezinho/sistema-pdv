<?php

namespace App\Repositories\Fornecedor;

use App\Config\Database;
use App\Interfaces\Fornecedor\IFornecedor;
use App\Models\Fornecedor\Fornecedor;
use App\Repositories\Traits\Find;

class FornecedorRepository implements IFornecedor {

    const CLASS_NAME = Fornecedor::class;
    const TABLE = 'emitente';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new Fornecedor();
    }

    public function all(array $params = []){
        $sql = "SELECT f.*, 
            e.id as end_id, e.uuid as end_uuid, e.cep as cep, e.uf as uf, e.codigo as codigo, e.ibge as ibge, e.cidade as cidade, e.rua as rua, e.bairro as bairro, e.numero as numero, e.complemento as complemento
            FROM " . self::TABLE . " f
            JOIN
                enderecos e 
            ON 
                enderecos_id = e.id
        ";
    
        $conditions = [];
        $bindings = [];
    
        if(isset($params['nome_razao']) && !empty($params['nome_razao'])){
            $conditions[] = "nome_fantasia LIKE :nome_razao";
            $bindings[':nome_razao'] = "%" . $params['nome_razao'] . "%" ;
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
        $fornecedor = $this->model->create($data);
        
        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    razao_social = :razao_social,
                    nome_fantasia = :nome_fantasia,
                    documento = :documento,
                    ie_rg = :ie_rg,
                    num_serie_nfe = :num_serie_nfe,
                    enderecos_id = :enderecos_id,
                    ativo = :ativo
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $fornecedor->uuid,
                ':razao_social' => $fornecedor->razao_social,
                ':nome_fantasia' => $fornecedor->nome_fantasia,
                ':documento' => $fornecedor->documento,
                ':ie_rg' => $fornecedor->ie_rg,
                ':num_serie_nfe' => $fornecedor->num_serie_nfe,
                ':enderecos_id' => $fornecedor->enderecos_id,
                ':ativo' => $fornecedor->ativo ?? 1
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($fornecedor->uuid);

        }catch(\Throwable $th){
            return $th;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function update(array $data, int $id){
        $fornecedor = $this->model->create($data);

        try{
            $sql = "UPDATE " . self::TABLE . "
                SET
                    razao_social = :razao_social,
                    nome_fantasia = :nome_fantasia,
                    documento = :documento,
                    ie_rg = :ie_rg,
                    num_serie_nfe = :num_serie_nfe,
                    ativo = :ativo
                WHERE 
                    id =:id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':razao_social' => $fornecedor->razao_social,
                ':nome_fantasia' => $fornecedor->nome_fantasia,
                ':documento' => $fornecedor->documento,
                ':ie_rg' => $fornecedor->ie_rg,
                ':num_serie_nfe' => $fornecedor->num_serie_nfe,
                ':ativo' => $fornecedor->ativo ?? 1,
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