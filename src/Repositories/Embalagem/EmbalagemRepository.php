<?php


namespace App\Repositories\Embalagem;

use App\Config\Database;
use App\Interfaces\Embalagem\IEmbalagem;
use App\Models\Embalagem\Embalagem;
use App\Repositories\Traits\Find;

class EmbalagemRepository implements IEmbalagem{

    const CLASS_NAME = Embalagem::class;

    protected $conn;
    protected $model;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
        $this->model = new Embalagem();
    }

    public function all(string $type, array $params = [])
    {
        $sql = "SELECT * FROM " . $type;

        $conditions = [];
        $bindings = [];

        if (isset($params['tipo']) && $params['tipo'] != "") {
            $conditions[] = "tipo = :tipo";
            $bindings[':tipo'] = $params['tipo'];
        }

        if (isset($params['ativo']) && $params['ativo'] != "") {
            $conditions[] = "ativo = :ativo";
            $bindings[':ativo'] = $params['ativo'];
        }

        if (count($conditions) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY id ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute($bindings);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::CLASS_NAME);
    }

    public function create(string $type, array $data)
    {
        $embalagem = $this->model->create($data);

        try {
            $sql = "INSERT INTO " . $type . "
                SET
                    uuid = :uuid,
                    quantidade = :quantidade,
                    tipo = :tipo,
                    ativo = :ativo
            ";

            $stmt = $this->conn->prepare($sql);

            $create = $stmt->execute([
                ':uuid' => $embalagem->uuid,
                ':quantidade' => $embalagem->quantidade,
                ':tipo' => $embalagem->tipo,
                ':ativo' => $embalagem->ativo ?? 1
            ]);

            if (!$create) {
                return null;
            }

            return $this->findByUuid($type, $embalagem->uuid);

        } catch (\Throwable $th) {
            return null;
        } finally {
            Database::getInstance()->closeConnection();
        }
    }

    public function delete(string $type, int $id)
    {
        try {
            $sql = "UPDATE " . $type . "
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

        } catch (\Throwable $th) {
            return null;
        } finally {
            Database::getInstance()->closeConnection();
        }
    }

    public function findById(string $type, int $id)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM " . $type . " WHERE id = :id"
        );

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::CLASS_NAME);
        $result = $stmt->fetch();

        if (is_null($result)) {
            return null;
        }

        return $result;
    }

    public function findByUuid(string $type, string $uuid)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM " . $type . " WHERE uuid = :uuid"
        );

        $stmt->execute([':uuid' => $uuid]);

        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, self::CLASS_NAME);
        $result = $stmt->fetch();

        if (empty($result)) {
            return null;
        }

        return $result;
    }

}