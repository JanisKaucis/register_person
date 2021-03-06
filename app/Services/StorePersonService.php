<?php
namespace App\Services;

use App\Repositories\Persons\StorageRepository;

class StorePersonService
{
private StorageRepository $repository;

    public function __construct(StorageRepository $repository)
    {
        $this->repository = $repository;
    }
    public function showAll(): array
    {
        return $this->repository->exportRepository()->getPersons();
    }
    public function search($value)
    {
    return $this->repository->search($value);
    }
    public function searchAfterCode($value)
    {
    return $this->repository->searchAfterCode($value);
    }
    public function update($updateField,$value,$code)
    {
        return $this->repository->update($updateField,$value,$code);
    }
    public function delete($code)
    {
        return $this->repository->delete($code);
    }
    public function addCode($personalCode,$code)
    {
        return $this->repository->addCode($personalCode,$code);
    }
    public function searchAfterToken($token)
    {
        return $this->repository->searchAfterToken($token);
    }
    public function getExpireTimeForToken($token)
    {
        return $this->repository->getExpireTimeForToken($token);
    }
    public function setExpireTimeForToken($token,$expireDate)
    {
        return $this->repository->setExpireTimeForToken($token,$expireDate);
    }
}