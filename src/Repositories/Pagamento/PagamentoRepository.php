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

        $sql .= " ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute($bindings);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::CLASS_NAME);
    }

    public function create(array $data, int $usuarios_id){}

    public function update(array $data, int $id){}

    public function delete(int $id){}

}