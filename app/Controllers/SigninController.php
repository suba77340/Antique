<?php

namespace App\Controllers;

use App\Services\SigninService;

class SigninController extends Controller
{
    private $signinService;

    public function __construct()
    {
        // Crée une instance de SigninService
        $this->signinService = new SigninService();
    }

    /**
     * Affiche la page de connexion
     */
    public function index()
    {
        // Vérifie si l'utilisateur est déjà connecté
        if (isset($_SESSION['user_id'])) {
            // Redirige vers la page d'accueil ou tableau de bord si l'utilisateur est connecté
            header('Location: /account');  
            exit();
        }

        // Rendre la vue de connexion
        $this->render('auth/signin');
    }

    /**
     * Gère la soumission du formulaire de connexion
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $csrfToken = $_POST['csrf_token'] ?? '';

            // Vérification du jeton CSRF
            $error = $this->signinService->checkCsrfToken($csrfToken);

            if ($error) {
                // Si le jeton CSRF est invalide, afficher l'erreur
                $this->render('auth/signin', ['error' => $error]);
                return;
            }

            // Authentification avec email et mot de passe
            $error = $this->signinService->authenticate($email, $password);

            if ($error) {
                // Si l'authentification échoue, afficher l'erreur
                $this->render('auth/signin', ['error' => $error]);
            } else {
                // Si l'authentification réussie, rediriger l'utilisateur
                header('Location: /'); // Remplacez par l'URL de destination après la connexion
                exit();
            }
        }
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
