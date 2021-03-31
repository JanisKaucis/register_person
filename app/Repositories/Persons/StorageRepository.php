<?php
namespace App\Repositories\Persons;

interface StorageRepository
{
    public function addPersons(): void;
    public function exportRepository(): object;
    public function search($value);
    public function searchAfterCode($value);
    public function update($updateField,$value,$code);
    public function delete($code);
}