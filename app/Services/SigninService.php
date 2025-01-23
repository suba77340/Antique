<?php

namespace App\Services;

use App\Repository\UserRepository;
use App\Repository\RoleRepository;

class SigninService
{
    private $userRepository;
    private $roleRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->roleRepository = new RoleRepository();
    }

    /**
     * Vérifie si le jeton CSRF envoyé est valide.
     */
    public function checkCsrfToken($token)
    {
        if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
            return 'Jeton CSRF invalide.';
        }
        return null;
    }

    /**
     * Authentifie un utilisateur en vérifiant l'email et le mot de passe.
     */
    public function authenticate($email, $password)
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            return 'Utilisateur non trouvé.';
        }

        if (!password_verify($password, $user['password'])) {
            return 'Mot de passe incorrect.';
        }

        // Récupérer le rôle de l'utilisateur
        $roleId = $user['role_id'];
        $role = $this->roleRepository->findById($roleId);

        if (!$role) {
            return 'Rôle de l\'utilisateur introuvable.';
        }

        // Enregistrer les informations dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['first_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $role->name;  // Accédez à la propriété 'name' de l'objet

        return null;  // L'utilisateur est authentifié et le rôle est défini
    }
}
