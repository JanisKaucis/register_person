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
            require_once 'app/Views/HomeView.php';
//        return $this->twigLoader->twig->render('HomeView.twig', $persons);
    }

    public function searchPerson(): void
    {
        session_start();
        if (isset($_POST['submit1'])) {
            $_SESSION['search'] = ucfirst($_POST['search']);
        }
        if (isset($_SESSION['search'])) {
            $results = $this->service->search($_SESSION['search']);
        }
        if (!empty($results)) {
            require_once 'app/Views/SearchView.php';
        }
        if (isset($_POST['clear1'])) {
            $_SESSION['search'] = [];
            header('Location: index.php');
        }
    }

    public function SearchAfterCode(): void
    {
        require_once 'app/Views/CodeInputView.php';
        if (isset($_POST['submit2'])) {
            $_SESSION['code'] = $_POST['code'];
        }
        if (isset($_SESSION['code'])) {
            $result = $this->service->searchAfterCode($_SESSION['code']);
        }
        if (!empty($result)) {
            require_once 'app/Views/CodeSearchView.php';
            require_once 'app/Views/DeleteOrUpdateView.php';
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
            require_once 'app/Views/UpdateInputView.php';
        }
        if (isset($_POST['submit3'])) {
            $this->service->update('notes', $_POST['notes'], $_SESSION['code']);
            header('Location: index.php');
        }
    }

    public function refreshData()
    {
        require_once 'app/Views/refreshView.php';
        if (isset($_POST['submit4'])) {
            session_destroy();
            header('Location: index.php');
        }
    }
}