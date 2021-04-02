<?php

namespace App\Controllers;

use App\Repositories\Persons\MySQLStorageRepository;
use App\Services\StorePersonService;
use App\Services\TwigService;

class HomeController
{
    public StorePersonService $service;
    public TwigService $twigLoader;

    public function __construct()
    {
        $this->service = new StorePersonService(new MySQLStorageRepository());
        $this->twigLoader = new TwigService();
    }

    public function getPersonsList()
    {
        $persons = $this->service->show();
        $context = [
            'persons' => $persons,
        ];
        echo $this->twigLoader->twig->render('HomeView.twig', $context);
    }

    public function searchPerson()
    {
        session_start();
        if (isset($_POST['submit1'])) {
            $_SESSION['search'] = ucfirst($_POST['search']);
        }
        if (isset($_SESSION['search'])) {
            $results = $this->service->search($_SESSION['search']);
        }
        if (!empty($results)) {
            $context = [
                'persons' => $results,
            ];
            echo $this->twigLoader->twig->render('SearchView.twig', $context);
        }
        if (isset($_POST['clear1'])) {
            $_SESSION['search'] = [];
            header('Location: index.php');
        }
    }

    public function SearchAfterCode()
    {
        echo $this->twigLoader->twig->render('CodeInputView.twig');
        if (isset($_POST['submit2'])) {
            $_SESSION['code'] = $_POST['code'];
        }
        if (isset($_SESSION['code'])) {
            $result = $this->service->searchAfterCode($_SESSION['code']);
        }
        if (!empty($result)) {
            $context = [
                'persons' => $result,
            ];
            echo $this->twigLoader->twig->render('CodeSearchView.twig', $context);
        }
        if (isset($_POST['clear2'])) {
            $_SESSION['code'] = [];
            header('Location: index.php');
        }

        if (isset($_POST['delete'])) {
            $this->service->delete($_SESSION['code']);
            header('Location: index.php');
        }
        if (isset($_POST['update'])) {
            echo $this->twigLoader->twig->render('UpdateInputView.twig');
        }
        if (isset($_POST['submit3'])) {
            $this->service->update('notes', $_POST['notes'], $_SESSION['code']);
            header('Location: index.php');
        }
    }

    public function refreshData()
    {
        echo $this->twigLoader->twig->render('RefreshView.twig');
        if (isset($_POST['submit4'])) {
            session_destroy();
            header('Location: index.php');
        }
    }
}