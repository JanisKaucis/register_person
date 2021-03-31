<?php
require_once 'vendor/autoload.php';
//pievieno vards uzvards, personas kods,piezimju bloks
//meklesana pec personas koda var atrast personu vai uzvarda
//iespeja dzest vai labot kad atrod, var labot tikai pierakstu bloku
//izvedo personas, vertibas, parbauda vai strada ar testu

use App\Repositories\Persons\MySQLStorageRepository;
use App\Controllers\HomeController;

$data = new MySQLStorageRepository();
$indexController = new HomeController();
$indexController->getPersonsList();
$indexController->searchPerson();
$indexController->SearchAfterCode();
$indexController->refreshData();
