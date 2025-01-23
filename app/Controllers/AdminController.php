<?php

namespace App\Controllers;

use App\Services\ReservationService;

class AdminController extends Controller
{
    private $reservationService;

    public function __construct()
    {
        $this->reservationService = new ReservationService();
    }

    // Action pour afficher les réservations des clients
    public function reservations()
    {
        // Vérifier que l'utilisateur est admin
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            // Récupérer toutes les réservations
            $reservations = $this->reservationService->getAllReservations();

            // Charger la vue avec les réservations
            echo $this->render('admin/reservations', ['reservations' => $reservations]);
        } else {
            // Rediriger l'utilisateur s'il n'est pas admin
            header('Location: /');
            exit;
        }
    }
}
