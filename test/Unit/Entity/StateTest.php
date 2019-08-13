<?php declare(strict_types=1);

namespace Taxation\Test\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Taxation\Entity\County;
use Taxation\Entity\State;

class StateTest extends TestCase
{
    public function testCanAddSameStateOnce()
    {
        $countryEntity = new County(['id' => 2, 'name' => 'state', 'states' => []]);

        $stateEntity = new State(['id' => 1, 'name' => 'test']);

        $stateEntity->addCounty($countryEntity);
        $stateEntity->addCounty($countryEntity);
        $stateEntity->addCounty($countryEntity);

        $this->assertEquals(1, $stateEntity->getCounties()->count());
        $this->assertEquals('state', $stateEntity->getCounties()->first()->getName());
    }

}