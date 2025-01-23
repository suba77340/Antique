<?php

namespace App\Services;

use App\Models\UserModel;
use App\Repository\UserRepository;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(); 
    }

    // Logique métier pour créer un utilisateur
    public function createUser(array $data)
    {
        // Assurez-vous que tous les champs nécessaires sont présents
        if (empty($data['username']) || empty($data['first_name']) || empty($data['last_name']) || empty($data['email']) || empty($data['password'])) {
            throw new \Exception("Tous les champs sont requis.");
        }

        // Hash du mot de passe
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        // Debug : Vérifie que le mot de passe est correctement haché
        var_dump($hashedPassword);  // Enlever après les tests

        // Créer un modèle d'utilisateur avec les données du formulaire
        $user = new UserModel();
        $user->setUsername($data['username']);
        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $user->setEmail($data['email']);
        $user->setPassword($hashedPassword);  // Assurez-vous que le mot de passe est bien haché avant de l'enregistrer

        // Enregistrer l'utilisateur dans la base de données via le repository
        return $this->userRepository->create($user);
    }

    // Si tu veux récupérer un utilisateur par son ID
    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function updateUser($id, array $userData)
    {
        return $this->userRepository->update($id, $userData);
    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->findByEmail($email);  // Assurez-vous que cette méthode renvoie un tableau associatif
    }

    public function deleteUser($userId)
    {
        // Supprimer l'utilisateur dans la base de données
        return $this->userRepository->delete($userId);
    }
}
