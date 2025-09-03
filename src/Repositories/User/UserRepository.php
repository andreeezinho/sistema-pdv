<?php

namespace App\Repositories\User;

use App\Config\Database;
use App\Interfaces\User\IUser;
use App\Models\User\User;
use App\Repositories\Traits\Find;

class UserRepository implements IUser {

    const CLASS_NAME = User::class;
    const TABLE = 'usuarios';

    use Find;

    protected $conn;
    protected $model;

    public function __construct(){
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new User();
    }

    public function login(string $usuario, string $senha){
        if(empty($usuario) || empty($senha)){
            return null;
        }

        $sql = "SELECT * FROM " . self::TABLE . "
            WHERE 
                usuario = :usuario
            AND
                ativo = 1
        ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':usuario' => $usuario
        ]);

        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::CLASS_NAME);
        $user = $stmt->fetch();

        if(!$user){
            return null;
        }

        if(!password_verify($senha, $user->senha)){
            return null;
        }

        unset($user->senha);

        return $user;
    }

    public function all(array $params = []){
        $sql = "SELECT * FROM " . self::TABLE;
    
        $conditions = [];
        $bindings = [];
    
        if(isset($params['nome_usuario']) && !empty($params['nome_usuario'])){
            $conditions[] = "nome LIKE :nome_usuario OR usuario LIKE :nome_usuario";
            $bindings[':nome_usuario'] = "%" . $params['nome_usuario'] . "%" ;
        }
    
        if(isset($params['cpf']) && !empty($params['cpf'])){
            $conditions[] = "cpf = :cpf";
            $bindings[':cpf'] = $params['cpf'];
        }
    
        if(isset($params['cargo']) && !empty($params['cargo'])){
            $conditions[] = "cargo = :cargo";
            $bindings[':cargo'] = $params['cargo'];
        }
    
        if(isset($params['ativo']) && $params['ativo'] != ""){
            $conditions[] = "ativo = :ativo";
            $bindings[':ativo'] = $params['ativo'];
        }
    
        if(count($conditions) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY created_at ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute($bindings);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::CLASS_NAME);
    }

    public function findUserByEmail(string $email){
        try{
            $sql = "SELECT * FROM " . self::TABLE . "
                WHERE 
                    email = :email
                AND
                    ativo = 1
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':email' => $email
            ]);

            $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::CLASS_NAME);
            $user = $stmt->fetch();

            if(!$user){
                return null;
            }

            unset($user->senha);

            return $user;
        }catch(\Throwable $th) {
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function create(array $data){
        $data = array_merge($data, ['senha' => 'senha123']);
        $usuario = $this->model->create($data);

        try{
            $sql = "INSERT INTO " . self::TABLE . "
                SET
                    uuid = :uuid,
                    usuario = :usuario,
                    nome = :nome,
                    email = :email,
                    cpf = :cpf,
                    telefone = :telefone,
                    senha = :senha,
                    cargo = :cargo,
                    is_admin = :is_admin,
                    ativo = :ativo,
                    icone = :icone
                ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $usuario->uuid,
                ':usuario' => $usuario->usuario,
                ':nome' => $usuario->nome,
                ':email' => $usuario->email,
                ':cpf' => $usuario->cpf,
                ':telefone' => $usuario->telefone,
                ':senha' => $usuario->senha,
                ':cargo' => $usuario->cargo,
                ':is_admin' => $usuario->is_admin,
                ':ativo' => $usuario->ativo,
                ':icone' => $usuario->icone
            ]);

            if(!$create){
                return null;
            }

            return $this->findByUuid($usuario->uuid);

        }catch(\Throwable $th){
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function update(array $data, int $id){
        $data = array_merge($data, ['senha' => 'senha123']);
        $usuario = $this->model->create($data);

        try{

            $sql = "UPDATE " .self::TABLE . "
                SET
                    usuario = :usuario,
                    nome = :nome,
                    email = :email,
                    cpf = :cpf,
                    telefone = :telefone,
                    cargo = :cargo,
                    is_admin = :is_admin,
                    ativo = :ativo
                WHERE
                    id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':usuario' => $usuario->usuario,
                ':nome' => $usuario->nome,
                ':email' => $usuario->email,
                ':cpf' => $usuario->cpf,
                ':telefone' => $usuario->telefone,
                ':cargo' => $usuario->cargo,
                ':is_admin' => $usuario->is_admin,
                ':ativo' => $usuario->ativo,
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

    public function updateIcone(int $id, array $icone, string $dir){
        $updateIcone = createImage($icone, $dir);

        if(is_null($updateIcone)){
            return null;
        }

        try{

            $sql = "UPDATE " . self::TABLE . "
                SET
                    icone = :icone
                WHERE 
                    id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':icone' => $updateIcone['arquivo_nome'],
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

    public function updateSenha(array $data, int $id){
        $usuario = $this->model->updateSenha($data);

        try{
            $sql = "UPDATE " .self::TABLE . "
                SET
                    senha = :senha
                WHERE
                    id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $update = $stmt->execute([
                ':senha' => $usuario->senha,
                ':id' => $id
            ]);

            if(!$update){
                return null;
            }

            $update = $this->findById($id);

            return $update;

        }catch(\Throwable $th){
            echo($th);
            return null;
        }finally{
            Database::getInstance()->closeConnection();
        }
    }

    public function delete(int $id){
        $sql = "UPDATE " . self::TABLE . "
            SET
                ativo = 0
            WHERE 
                id = :id
        ";

        $stmt = $this->conn->prepare($sql);

        $delete = $stmt->execute([
            ':id' => $id
        ]);

        return $delete;
    }

}