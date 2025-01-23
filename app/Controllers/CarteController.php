<?php

namespace App\Controllers;

use App\Controllers\Controller;

class CarteController extends Controller
{
    public function index()
    {
        // Logique pour afficher la carte du restaurant (menu)
        $this->render('pages/carte');  // Assure-toi que la vue 'pages/carte' existe
    }
}
