<?php

use App\Autoloader;
use App\Config\Main;
use Dotenv\Dotenv;

// Define the ROOT constant to indicate the root directory of the project
define('ROOT', dirname(__DIR__));

// Include the autoloader to automatically manage the loading of classes
require_once __DIR__ . '/../Autoloader.php';

Autoloader::register();

// Load environment variables from the .env file in the root directory
// Assurez-vous que les variables d'environnement sont définies dans Heroku
$_ENV['DB_HOST'] = getenv('DB_HOST');
$_ENV['DB_NAME'] = getenv('DB_NAME');
$_ENV['DB_USER'] = getenv('DB_USER');
$_ENV['DB_PASS'] = getenv('DB_PASS');
$_ENV['DB_PORT'] = getenv('DB_PORT');


// Start the application
$app = new Main();
$app->start();
