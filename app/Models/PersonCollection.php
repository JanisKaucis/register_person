<?php
namespace App\Models;

class PersonCollection
{
    private array $persons = [];

    public function setPersons($person): void
    {
        $this->persons[] = $person;
    }

    public function getPersons(): array
    {
        return $this->persons;
    }
}