<?php

namespace App\Services;

use App\Models\ReservationModel;
use App\Repository\ReservationRepository;

class ReservationService
{
    private $reservationRepository;

    public function __construct()
    {
        $this->reservationRepository = new ReservationRepository();
    }

    // Logique métier pour créer une réservation
    public function createReservation($data)
    {
        // Assurez-vous que l'utilisateur est connecté et récupérez son ID
        if (!isset($_SESSION['user_id'])) {
            throw new \Exception('L\'utilisateur n\'est pas connecté');
        }

        $userId = $_SESSION['user_id']; // ID de l'utilisateur connecté

        // Créer une nouvelle instance du modèle Reservation et hydrater avec les données
        $reservation = new ReservationModel();
        $reservation->setName($data['Nom'])
            ->setPrenom($data['Prenom'])
            ->setAllergies($data['Allergies'])
            ->setNbConvives($data['NbConvives'])
            ->setDate($data['Date'])
            ->setHeure($data['Heure'])
            ->setUserId($userId);

        // Enregistrer la réservation dans la base de données
        return $this->reservationRepository->create($reservation);
    }

    public function getReservationsByUser($userId)
    {
        return $this->reservationRepository->findBy(['user_id' => $userId]);
    }

    // Récupérer toutes les réservations, pour l'administration
    public function getAllReservations()
    {
        return $this->reservationRepository->findAll();
    }
}
