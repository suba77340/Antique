<?php

namespace App\Repository;

use App\Models\RoleModel;
use App\Config\Db;

class RoleRepository extends DbRepository
{
    protected $table = 'roles';  // Table qui contient les rôles (admin, user, etc.)

    /**
     * Trouver un rôle par son ID
     */
    public function findById($roleId)
    {
        $sql = "SELECT * FROM roles WHERE id = :id";
        $stmt = Db::getInstance()->prepare($sql);
        $stmt->execute(['id' => $roleId]);
        return $stmt->fetch();  // Cela renvoie un objet stdClass
    }


    /**
     * Trouver un rôle par son nom
     */
    public function findByName(string $name)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE name = :name";
        $stmt = Db::getInstance()->prepare($sql);
        $stmt->execute(['name' => $name]);

        // Retourner le résultat sous forme d'objet RoleModel
        $roleData = $stmt->fetch();
        if ($roleData) {
            $role = new RoleModel();
            $role->setId($roleData['id']);
            $role->setName($roleData['name']);
            return $role;
        }

        return null;
    }

    /**
     * Créer un nouveau rôle
     */
    public function create($role)
    {
        $sql = "INSERT INTO " . $this->table . " (name) VALUES (:name)";

        try {
            $stmt = Db::getInstance()->prepare($sql);
            $stmt->execute(['name' => $role->getName()]);
            return Db::getInstance()->lastInsertId();
        } catch (\PDOException $e) {
            die("Erreur lors de l'insertion du rôle: " . $e->getMessage());
        }
    }
}
