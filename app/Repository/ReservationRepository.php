<?php

namespace App\Repository;

use App\Models\ReservationModel;
use App\Config\Db;

class ReservationRepository extends DbRepository
{
    protected $table = 'reservations';

    public function create($reservation)
    {
        // Vérifiez que $reservation est un objet de type ReservationModel
        if (!$reservation instanceof ReservationModel) {
            throw new \InvalidArgumentException('L\'argument doit être un objet ReservationModel.');
        }

        // Récupérer les valeurs via les méthodes getter
        $name = $reservation->getName();
        $prenom = $reservation->getPrenom();
        $allergies = $reservation->getAllergies();
        $nbConvives = $reservation->getNbConvives();
        $date = $reservation->getDate();
        $heure = $reservation->getHeure();
        $userId = $reservation->getUserId();

        // Préparez la requête d'insertion avec des paramètres nommés
        $sql = "INSERT INTO " . $this->table . " (name, prenom, allergies, nbConvives, date, heure, user_id) 
        VALUES (:name, :prenom, :allergies, :nbConvives, :date, :heure, :userId)";

        // Exécute la requête en liant les paramètres nommés
        $result = $this->req($sql, [
            'name' => $name,
            'prenom' => $prenom,
            'allergies' => $allergies,
            'nbConvives' => $nbConvives,
            'date' => $date,
            'heure' => $heure,
            'userId' => $userId,
        ]);

        // Retourner l'id de la réservation insérée ou null en cas d'erreur
        if ($result) {
            // Récupère l'ID de la dernière insertion via la méthode getInstance()
            return Db::getInstance()->lastInsertId(); // Retourne l'ID de la dernière insertion
        }

        return null; // En cas d'échec

    }

    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        foreach ($criteres as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        $listeChamps = implode(' AND ', $champs);

        return $this->req("SELECT * FROM " . $this->table . " WHERE " . $listeChamps, $valeurs)->fetchAll();
    }

    public function findAll()
    {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = Db::getInstance()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Retourne toutes les réservations sous forme de tableau associatif
    }
}
