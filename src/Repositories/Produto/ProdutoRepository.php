<?php

namespace App\Repositories\Produto;

use App\Config\Database;
use App\Interfaces\Produto\IProduto;
use App\Models\Produto\Produto;
use App\Repositories\Traits\Find;

class ProdutoRepository implements IProduto {

    const CLASS_NAME = Produto::class;
    const TABLE = 'produtos';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new Produto();
    }

    public function all(array $params = []){
        $sql = "SELECT * FROM " . self::TABLE;
    
        $conditions = [];
        $bindings = [];

        if(isset($params['nome_codigo']) && !empty($params['nome_codigo'])){
            $conditions[] = "nome LIKE :nome_codigo OR codigo LIKE :nome_codigo";
            $bindings[':nome_codigo'] = "%" . $params['nome_codigo'] . "%";
        }

        if(isset($params['tipo']) && $params['tipo'] != ""){
            $conditions[] = "tipo = :tipo";
            $bindings[':tipo'] = $params['tipo'];
        }
    
        if(isset($params['ativo']) && $params['ativo'] != ""){
            $conditions[] = "ativo = :ativo";
            $bindings[':ativo'] = $params['ativo'];
        }
    
        if(count($conditions) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY nome ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute($bindings);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::CLASS_NAME);
    }

    public function create(array $data){
        $produto = $this->model->create($data);
        
        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    nome = :nome,
                    codigo = :codigo,
                    preco = :preco,
                    estoque = :estoque,
                    tipo = :tipo,
                    ativo = :ativo
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $produto->uuid,
                ':nome' => $produto->nome,
                ':codigo' => $produto->codigo,
                ':preco' => $produto->preco,
                ':estoque' => $produto->estoque,
                ':tipo' => $produto->tipo,
                ':ativo' => $produto->ativo ?? 1
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($produto->uuid);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function update(array $data, int $id){
        $produto = $this->model->create($data);

        try{
            $sql = "UPDATE " . self::TABLE . "
                SET
                    nome = :nome,
                    codigo = :codigo,
                    preco = :preco,
                    estoque = :estoque,
                    tipo = :tipo,
                    ativo = :ativo
                WHERE 
                    id =:id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':nome' => $produto->nome,
                ':codigo' => $produto->codigo,
                ':preco' => $produto->preco,
                ':estoque' => $produto->estoque,
                ':tipo' => $produto->tipo,
                ':ativo' => $produto->ativo,
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

    public function subtractProduct(int $id, int $quantity){
        try{
            
            $sql = "UPDATE " . self::TABLE . "
                SET 
                    estoque = :estoque
                WHERE
                    id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':estoque' => $quantity,
                ':id' => $id
            ]);

            return $update;

        }catch(\Thorwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function verifyProductQuantity(array $all_products, array $vendaProdutos){
        foreach($all_products as $produto_estoque){
            foreach($vendaProdutos as $produto){
                if($produto_estoque->id == $produto->produtos_id){
                    $quantidade = $produto_estoque->estoque;
                    if($produto_estoque->estoque > 0){
                        if(($quantidade - $produto->quantidade) < 0){
                            return false; break;
                        }

                        $quantidade = $quantidade - $produto->quantidade;
                    }
    
                    $subtractProduct = $this->subtractProduct($produto->produtos_id, $quantidade);
                }
            }
        }

        return true;
    }

    public function findByCode(int $codigo){
        $stmt = $this->conn->prepare(
            "SELECT * FROM " . self::TABLE . " WHERE codigo = :codigo AND ativo = 1"
        );

        $stmt->execute([':codigo' => $codigo]);

        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::CLASS_NAME);
        $result = $stmt->fetch();

        if(empty($result)){
            return null;
        }

        return $result;
    }

}