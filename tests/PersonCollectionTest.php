<?php

namespace Tests;

use App\Models\Person;
use App\Models\PersonCollection;
use PHPUnit\Framework\TestCase;

class PersonCollectionTest extends TestCase
{
    public function testPersonCollection()
    {
        $person1 = new Person('Janis','Alksnis',13,'111111-11111','Valmiera','blendaris');
        $person2 = new Person('Janis','Alksnis',13,'111111-11111','Valmiera','blendaris');
        $personCollection = new PersonCollection();
        $personCollection->setPersons($person1);
        $personCollection->setPersons($person2);
        $this->assertCount(2,$personCollection->getPersons());
    }
}