<?php declare(strict_types=1);

namespace Taxation\Test\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Taxation\Entity\Country;
use Taxation\Entity\State;

class CountryTest extends TestCase
{
    public function testCanAddSameStateOnce()
    {
        $countryEntity = new Country(['id' => 2, 'name' => 'state', 'states' => []]);

        $stateEntity = new State(['id' => 1, 'name' => 'test']);

        $countryEntity->addState($stateEntity);
        $countryEntity->addState($stateEntity);
        $countryEntity->addState($stateEntity);

        $this->assertEquals(1, $countryEntity->getStates()->count());
        $this->assertEquals('test', $countryEntity->getStates()->first()->getName());
    }

}