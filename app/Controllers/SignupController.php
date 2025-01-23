<?php


namespace App\Controllers;

use App\Services\UserService;

class SignupController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        $csrfToken = $_SESSION['csrf_token'];
        $this->render('auth/signup', ['csrfToken' => $csrfToken]);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';
            $csrfToken = $_POST['csrf_token'] ?? '';
    
            // Vérification du jeton CSRF
            if ($csrfToken !== $_SESSION['csrf_token']) {
                $this->render('auth/signup', ['error' => 'Jeton CSRF invalide']);
                return;
            }
    
            // Validation des champs
            if (empty($username) || empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($passwordConfirm)) {
                $this->render('auth/signup', ['error' => 'Tous les champs doivent être remplis']);
                return;
            }
    
            if ($password !== $passwordConfirm) {
                $this->render('auth/signup', ['error' => 'Les mots de passe ne correspondent pas']);
                return;
            }
    
            // Ajouter un log pour vérifier la valeur du mot de passe avant le hachage
            if (empty($password)) {
                $this->render('auth/signup', ['error' => 'Le mot de passe ne peut pas être vide']);
                return;
            }
    
            try {
                // Vérification de la validité du mot de passe
                if (strlen($password) < 6) { // Ajoute une vérification de la longueur du mot de passe
                    $this->render('auth/signup', ['error' => 'Le mot de passe doit contenir au moins 6 caractères']);
                    return;
                }
    
                // Hachage du mot de passe avant insertion
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
                // Créer l'utilisateur avec les informations et le mot de passe haché
                $userData = [
                    'username' => $username,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email,
                    'password' => $hashedPassword  // Assurez-vous que le mot de passe est bien haché avant de l'enregistrer
                ];
    
                // Créer l'utilisateur via le service
                $this->userService->createUser($userData);
    
                // Rediriger vers la page de connexion après inscription
                header('Location: /signin');
                exit();  // Ne pas oublier de terminer le script après une redirection
            } catch (\Exception $e) {
                $this->render('auth/signup', ['error' => $e->getMessage()]);
            }
        }
    }
}
