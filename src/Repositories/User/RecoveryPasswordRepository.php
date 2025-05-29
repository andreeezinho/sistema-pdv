<?php

namespace App\Repositories\User;

use App\Config\Database;
use App\Interfaces\User\IRecoveryPassword;
use App\Models\User\RecoveryPassword;
use App\Repositories\Traits\Find;

class RecoveryPasswordRepository implements IRecoveryPassword {

    const CLASS_NAME = RecoveryPassword::class;
    const TABLE = 'recuperar_senha';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new RecoveryPassword();
    }

    public function create(int $usuarios_id, array $data = null){
        $recuperar = $this->model->create(null, $usuarios_id);

        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    usuarios_id = :usuarios_id,
                    codigo = :codigo
                ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $recuperar->uuid,
                ':usuarios_id' => $recuperar->usuarios_id,
                ':codigo' => $recuperar->codigo
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($recuperar->uuid);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function delete(int $id, int $usuarios_id){
        try{
            $sql = "DELETE FROM " . self::TABLE . "
                WHERE
                    usuarios_id = :usuarios_id
                AND
                    id = :id
                ";

            $stmt = $this->conn->prepare($sql);

            $delete = $stmt->execute([
                ':usuarios_id' => $usuarios_id,
                ':id' => $id
            ]);

            return $delete;

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function findByCodeAndUser(int $usuarios_id, int $code){
        try{
            $sql = "SELECT * FROM " . self::TABLE . "
                WHERE 
                    usuarios_id = :usuarios_id
                AND
                    codigo = :codigo
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':usuarios_id' => $usuarios_id,
                ':codigo' => $code
            ]);

            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::CLASS_NAME);
            $result = $stmt->fetch();

            if(!$result){
                return null;
            }

            return $result;
        }catch(\Throwable $th) {
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

}