<?php

namespace App\Models;

class ReservationModel
{
    private $id;
    private $name;
    private $prenom;
    private $allergies;
    private $nbConvives;
    private $date;
    private $heure;
    private $userId;

    // Getters et Setters pour chaque propriété

    public function getId() { return $this->id; }
    public function setId($id)
    {
        $this->id = $id;
        return $this; // Retourner l'objet actuel pour chaîner les appels
    }

    public function getName() { return $this->name; }
    public function setName($name)
    {
        $this->name = $name;
        return $this; // Retourner l'objet actuel pour chaîner les appels
    }

    public function getPrenom() { return $this->prenom; }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this; // Retourner l'objet actuel pour chaîner les appels
    }

    public function getAllergies() { return $this->allergies; }
    public function setAllergies($allergies)
    {
        $this->allergies = $allergies;
        return $this; // Retourner l'objet actuel pour chaîner les appels
    }

    public function getNbConvives() { return $this->nbConvives; }
    public function setNbConvives($nbConvives)
    {
        $this->nbConvives = $nbConvives;
        return $this; // Retourner l'objet actuel pour chaîner les appels
    }

    public function getDate() { return $this->date; }
    public function setDate($date)
    {
        $this->date = $date;
        return $this; // Retourner l'objet actuel pour chaîner les appels
    }

    public function getHeure() { return $this->heure; }
    public function setHeure($heure)
    {
        $this->heure = $heure;
        return $this; // Retourner l'objet actuel pour chaîner les appels
    }

    public function getUserId() { return $this->userId; }
    public function setUserId($userId) 
    {
        $this->userId = $userId;
        return $this;
    }
}
