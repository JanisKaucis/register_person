<?php

namespace Tests;

use App\Models\Person;
use PHPUnit\Framework\TestCase;

class PersonCreateTest extends TestCase
{
    public function testPerson()
    {
    $person = new Person('Janis','Alksnis',13,'111111-11111','Valmiera','blendaris');
    $this->assertEquals('Janis',$person->getName());
    $this->assertEquals('Alksnis',$person->getSurname());
    $this->assertEquals(13,$person->getAge());
    $this->assertEquals('111111-11111',$person->getPersonalCode());
    $this->assertEquals('Valmiera',$person->getAddress());
    $this->assertEquals('blendaris',$person->getNotes());
    }
}