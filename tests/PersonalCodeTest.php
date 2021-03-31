<?php

namespace Tests;
use App\Repositories\Persons\MySQLStorageRepository;
use App\Services\StorePersonService;
use PHPUnit\Framework\TestCase;

class PersonalCodeTest extends TestCase
{
    public function testPersonalCodeLength()
    {
        $data = new StorePersonService(new MySQLStorageRepository());
        foreach ($data->show() as $person){
            $this->assertEquals(12,strlen($person->getPersonalCode()));
        }
    }
    public function testForLine()
    {
        $data = new StorePersonService(new MySQLStorageRepository());
        foreach ($data->show() as $person){
            $this->assertEquals('-',$person->getPersonalCode()[6]);
        }
    }
    public function testNumbers()
    {
        $data = new StorePersonService(new MySQLStorageRepository());

        foreach ($data->show() as $person){
            $value = explode('-',$person->getPersonalCode());
                $this->assertEquals(6,strlen(intval($value[0])));
                $this->assertEquals(5,strlen(intval($value[1])));
        }

    }
}