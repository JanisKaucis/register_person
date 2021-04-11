<?php

require_once '../../vendor/autoload.php';

//ir login kur ievada personas kodu lai autorizetos,suta kodu
//kods saglabajas datubaze un ar kodu var autorizeties db

use App\Controllers\PersonLoginController;

$loginController = new PersonLoginController();
$loginController->login();