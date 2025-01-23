<?php

namespace App\Repository;

use App\Models\UserModel;
use App\Config\Db;

class UserRepository extends DbRepository
{
    protected $table = 'user';

    public function create( $user)
    {
        $username = $user->getUsername();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $sql = "INSERT INTO " . $this->table . " (username, first_name, last_name, email, password) 
                VALUES (:username, :first_name, :last_name, :email, :password)";

        try {
            $stmt = Db::getInstance()->prepare($sql);
            $stmt->execute([
                'username' => $username,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'password' => $password
            ]);
            return Db::getInstance()->lastInsertId(); // Retourner l'ID de l'utilisateur inséré
        } catch (\PDOException $e) {
            die("Erreur lors de l'insertion de l'utilisateur: " . $e->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        // Préparez la requête SQL pour la mise à jour des informations de l'utilisateur
        $sql = "UPDATE " . $this->table . " SET
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                password = :password
                WHERE id = :id";

        $stmt = Db::getInstance()->prepare($sql);

        // Exécuter la requête avec les données fournies
        $stmt->execute([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'id' => $id
        ]);

        return true;
    }

    public function findById(int $id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = Db::getInstance()->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = Db::getInstance()->prepare($sql);
        $stmt->execute(['email' => $email]);
        
        // Retourner le premier résultat sous forme de tableau associatif
        return $stmt->fetch(\PDO::FETCH_ASSOC);  // Utilisation de PDO::FETCH_ASSOC
    }
    
    public function delete($userId)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";

        try {
            $stmt = Db::getInstance()->prepare($sql);
            $stmt->execute(['id' => $userId]);
            return true;
        } catch (\PDOException $e) {
            die("Erreur lors de la suppression de l'utilisateur: " . $e->getMessage());
        }
    }

}

