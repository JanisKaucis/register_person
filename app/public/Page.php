<?php
require_once '../../vendor/autoload.php';
require_once 'index.php';

use App\Controllers\PageController;

$pageController = new PageController();
$pageController->findPerson();