<?php

//IMPORTAR CLASSES
use Model\ActiveRecord;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'database.php';
require 'funciones.php';

// Conectarnos a la base de datos

ActiveRecord::setDB($db);
