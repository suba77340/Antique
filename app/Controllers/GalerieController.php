<?php

namespace App\Controllers;

use App\Controllers\Controller;

class GalerieController extends Controller
{
    public function index()
    {
        // Logique pour la galerie
        // Par exemple, récupérer les images ou les albums
        $this->render('pages/galerie');  // Assure-toi que la vue 'pages/galerie' existe
    }
}
