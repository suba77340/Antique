<?php

namespace App\Controllers;

use App\Services\UserService;

class AccountController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService(); // Appel du service utilisateur
    }

    public function index()
    {
        // Vérification si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /signin');
            exit();
        }

        // Récupérer les informations de l'utilisateur
        $user = $this->userService->getUserById($_SESSION['user_id']);

        $this->render('auth/account', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $currentPassword = $_POST['currentPassword'] ?? '';
            $newPassword = $_POST['newPassword'] ?? '';
            $confirmNewPassword = $_POST['confirmNewPassword'] ?? '';

            // Vérification du mot de passe actuel
            $user = $this->userService->getUserById($_SESSION['user_id']);
            if (!password_verify($currentPassword, $user->password)) {
                $this->render('auth/account', ['error' => 'Le mot de passe actuel est incorrect.']);
                return;
            }

            // Vérification que les nouveaux mots de passe correspondent
            if ($newPassword !== $confirmNewPassword) {
                $this->render('auth/account', ['error' => 'Les nouveaux mots de passe ne correspondent pas.']);
                return;
            }

            // Mise à jour des informations
            $data = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
            ];

            // Si un nouveau mot de passe est fourni, l'ajouter au tableau de données
            if ($newPassword) {
                $data['password'] = password_hash($newPassword, PASSWORD_BCRYPT);
            }

            $this->userService->updateUser($user->id, $data);

            $this->render('auth/account', ['success' => 'Vos informations ont été mises à jour avec succès.']);
        }
    }

    public function delete()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /signin');
            exit();
        }

        // Récupérer l'utilisateur connecté
        $userId = $_SESSION['user_id'];

        // Appeler le service pour supprimer l'utilisateur
        $this->userService->deleteUser($userId);

        // Supprimer les données de la session
        session_unset();
        session_destroy();

        // Rediriger vers la page d'accueil ou la page de connexion
        header('Location: /');
        exit();
    }

    public function logout()
    {
        // Supprimer les données de la session
        session_unset();
        session_destroy();

        // Rediriger vers la page de connexion après la déconnexion
        header('Location: /signin');
        exit();
    }
}
