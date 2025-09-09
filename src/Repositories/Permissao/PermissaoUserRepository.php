<?php

namespace App\Repositories\Permissao;

use App\Config\Database;
use App\Interfaces\Permissao\IPermissaoUser;
use App\Models\Permissao\PermissaoUser;
use App\Repositories\Traits\Find;
use App\Repositories\User\UserRepository;

class PermissaoUserRepository implements IPermissaoUser {

    const CLASS_NAME = PermissaoUser::class;
    const TABLE = 'permissao_usuario';

    use Find;

    protected $conn;
    protected $model;
    protected $userRepository;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new PermissaoUser();
        $this->userRepository = new UserRepository();
    }

    public function allUserPermissions(int $usuario_id){
        $sql = "SELECT pu.id, pu.uuid, pu.permissoes_id, p.nome FROM " . self::TABLE . " pu
            JOIN permissoes p 
            ON pu.permissoes_id = p.id
            WHERE pu.usuarios_id = :usuario_id
            ORDER BY pu.id ASC
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':usuario_id' => $usuario_id
        ]);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::CLASS_NAME);
    }

    public function linkUserPermission($data, int $usuario_id){
        try{

            if (empty($data['permissions'])) {
                $this->unlinkUserPermission($usuario_id);

                return false;
            }

            if (!$this->unlinkUserPermission($usuario_id)) {
                return false;
            }

            foreach($data['permissions'] as $permissao){
                $permissao_user = $this->model->create((int)$permissao, (int)$usuario_id);

                $sql = "INSERT INTO " . self::TABLE . "
                    SET
                        uuid = :uuid,
                        permissoes_id = :permissoes_id,
                        usuarios_id = :usuarios_id
                ";

                $stmt = $this->conn->prepare($sql);

                $create = $stmt->execute([
                    ':uuid' => $permissao_user->uuid,
                    ':permissoes_id' => (int)$permissao,
                    ':usuarios_id' => (int)$usuario_id,
                ]);

                if(!$create){
                    return false;
                }
            }
            
            return true;

        }catch(\Throwable $th){
            return $th;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function unlinkUserPermission(int $usuario_id){
        $sql = "DELETE FROM " . self::TABLE . "
            WHERE
                usuarios_id = :usuarios_id
        ";

        $stmt = $this->conn->prepare($sql);

        $delete = $stmt->execute([
            ':usuarios_id' => $usuario_id
        ]);

        return $delete;
    }

}