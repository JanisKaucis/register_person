<?php
require_once '../../vendor/autoload.php';

use App\Controllers\PersonLoginController;

$loginController = new PersonLoginController();
$loginController->enterToken();
