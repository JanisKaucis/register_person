<?php

namespace App\Repositories\Persons;

use Medoo\Medoo;
use App\Models\PersonCollection;
use App\Models\Person;

class MySQLStorageRepository implements StorageRepository
{
    private Medoo $database;
    private object $personCollection;

    public function __construct()
    {
        $this->database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'PersonRegister',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ]);
        $this->addPersons();
    }

    public function addPersons(): void
    {
        $persons = $this->database->select('Persons', '*');
        $this->personCollection = new PersonCollection();
        foreach ($persons as $person) {
            $this->personCollection->setPersons(new Person($person['name'], $person['surname'],$person['age'], $person['personal_code'],$person['address'], $person['notes']));
        }
    }

    public function exportRepository(): object
    {
        return $this->personCollection;
    }

    public function search($value): array
    {
        $search = [];
        foreach ($this->personCollection->getPersons() as $person){
            if ($value === $person->getName() || $value === $person->getSurname() ||
                $value === $person->getAge() || $value === $person->getPersonalCode() ||
                $value === $person->getAddress()){
            $search = $this->database->select('Persons','*',["OR" => ['name' => $value,
                'surname' => $value,'age' => $value, 'personal_code' => $value,'address' => $value]]);
            }
        }
        return $search;
    }
    public function searchAfterCode($value): array
    {
        $search = [];
        foreach ($this->personCollection->getPersons() as $person){
            if ($value === $person->getPersonalCode()){
                $search = $this->database->select('Persons','*',['personal_code' => $value]);
            }
        }
        return $search;
    }
    public function update($updateField,$value,$code)
    {
        $this->database->update('Persons',[$updateField => $value],['personal_code' => $code]);
    }
    public function delete($code)
    {
        $this->database->delete('Persons',['personal_code' => $code]);
    }
    public function addCode($personalCode,$code){
        $this->database->update('Persons',['LoginCode' => $code],['personal_code' => $personalCode]);
    }
    public function searchAfterToken($token):array
    {
        $search = $this->database->select('Persons','*',['LoginCode' => $token]);
        return $search;
    }
    public function setExpireTimeForToken($token,$expireDate)
    {
        $this->database->update('Persons',['TokenExpireDate' => $expireDate],['LoginCode' => $token]);
    }
    public function getExpireTimeForToken($token)
    {
        return $this->database->select('Persons',['TokenExpireDate'],['LoginCode' => $token]);
    }
}

