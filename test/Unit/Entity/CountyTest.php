<?php declare(strict_types=1);

namespace Taxation\Test\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Taxation\Entity\County;
use Taxation\Entity\TaxRate;

class CountyTest extends TestCase
{
    public function testCanAddSameTaxRateOnce()
    {
        $countyEntity = new County(['id' => 2, 'name' => 'state']);

        $taxRateEntity1 = new TaxRate(['id' => 1, 'code' => 'test', 'rate' =>33, 'taxAmount' => 1]);
        $taxRateEntity2 = new TaxRate(['id' => 2, 'code' => 'test2', 'rate' =>33, 'taxAmount' => 1]);

        $countyEntity->addTaxRate($taxRateEntity1);
        $countyEntity->addTaxRate($taxRateEntity2);

        $this->assertInstanceOf('\Taxation\Entity\TaxRate', $countyEntity->getTaxRate());
        $this->assertEquals('test', $countyEntity->getTaxRate()->getCode());
    }
}