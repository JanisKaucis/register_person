<?php

namespace App\Controllers;
//ir login kur ievada personas kodu lai autorizetos,suta kodu
//kods saglabajas datubaze un ar kodu var autorizeties db

use App\Repositories\Persons\MySQLStorageRepository;
use App\Services\StorePersonService;
use App\Services\TwigService;

class PersonLoginController
{
    private StorePersonService $service;
    private TwigService $twigLoader;

    public function __construct()
    {
        $this->service = new StorePersonService(new MySQLStorageRepository());
        $this->twigLoader = new TwigService();
    }

    public function login()
    {
        if (isset($_POST['validate'])) {
            $_SESSION['personSearch'] = $_POST['personSearch'];
            $person = $this->service->searchAfterCode($_POST['personSearch']);
            if (empty($_POST['personSearch'])) {
                $error = 'Enter Personal Code';
            } elseif (empty($person)) {
                $error = 'Invalid Personal Code';
            } else {
                header("Location: GetTokenPage");
            }
        }
        $context = [
            'error' => $error
        ];
        echo $this->twigLoader->twig->render('LoginView.twig', $context);
    }

    public function getToken()
    {
        $token = uniqid();
        $expireDate = strtotime('+10 minutes');
        $this->service->addCode($_SESSION['personSearch'], $token);
        $this->service->setExpireTimeForToken($token, $expireDate);
        $uniqId = [
            'uniqId' => $token
        ];
        echo $this->twigLoader->twig->render('LoginContinueView.twig', $uniqId);
    }

    public function enterToken()
    {
        if (isset($_POST['tokenSubmit'])) {
            $_SESSION['token'] = $_POST['token'];
            $person = $this->service->searchAfterToken($_POST['token']);
            $expireDateForToken = $this->service->getExpireTimeForToken($_POST['token']);
            $expireDateForToken = intval($expireDateForToken[0]['TokenExpireDate']);
            if (empty($_POST['token'])) {
                $errorMessage = 'Enter Token';
            } elseif (empty($person)) {
                $errorMessage = 'Invalid Token';
            } elseif (strtotime("now") > $expireDateForToken) {
                $errorMessage = 'Token Has Expired';
            } else {
                header('Location: Page');
            }
        }
        $message = [
            'errorMessage' => $errorMessage
        ];
        echo $this->twigLoader->twig->render('TokenView.twig', $message);
    }
}