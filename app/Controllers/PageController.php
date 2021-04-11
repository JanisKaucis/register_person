<?php

namespace App\Controllers;

use App\Repositories\Persons\MySQLStorageRepository;
use App\Services\StorePersonService;
use App\Services\TwigService;

class PageController
{
    private StorePersonService $service;
    private TwigService $twigLoader;

    public function __construct()
    {
        $this->service = new StorePersonService(new MySQLStorageRepository());
        $this->twigLoader = new TwigService();
    }
    public function findPerson()
    {
        $person = $this->service->searchAfterToken($_SESSION['token']);
        $name = [
            'name' => $person[0]['name'],
            'surname' => $person[0]['surname']
        ];

        echo $this->twigLoader->twig->render('PageView.twig', $name);
    }
}