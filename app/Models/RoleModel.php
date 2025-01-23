<?php

namespace App\Models;

class RoleModel
{
    public $id;
    public $name;

    // Getters et Setters pour chaque propriété
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
