<?php
namespace App\Models;

class Person
{
    private $name;
    private $surname;
    private $age;
    private $personalCode;
    private $address;
    private $notes;

    public function __construct($name, $surname,$age, $personalCode, $address, $notes)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->personalCode = $personalCode;
        $this->address = $address;
        $this->notes = $notes;
    }
    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getPersonalCode()
    {
        return $this->personalCode;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getNotes()
    {
        return $this->notes;
    }
}