<?php

namespace App\Controllers;

use App\Services\ReservationService;

class AllresaController extends Controller
{
    private $reservationService;

    public function __construct()
    {
        // Instancier le service de réservation
        $this->reservationService = new ReservationService();
    }

    public function index()
    {
        // Vérification si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /signin');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $reservations = $this->reservationService->getReservationsByUser($userId);
    
        // Afficher les réservations sur la page allresa.php
        $this->render('reservation/allresa', ['reservations' => $reservations]);
    }

    public function make()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'Nom' => $_POST['Nom'],
                'Prenom' => $_POST['Prenom'],
                'Allergies' => $_POST['Allergies'],
                'NbConvives' => $_POST['NbConvives'],
                'Date' => $_POST['Date'],
                'Heure' => $_POST['Heure']
            ];

            // Appeler le service pour créer la réservation
            $this->reservationService->createReservation($data);

            // Rediriger ou afficher un message de confirmation
            header('Location: /allresa');
            exit();
        }
    }
}
