<?php declare(strict_types=1);

namespace Taxation\Test\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Taxation\Entity\TaxRate;

class TaxRateTest extends TestCase
{
    public function testEntityDataIsCorrect()
    {
        $taxRateEntity = new TaxRate(['id' => 2, 'code' => 'test2', 'rate' =>33, 'taxAmount' => 1]);

        $this->assertEquals(33, $taxRateEntity->getRate());
        $this->assertEquals(1, $taxRateEntity->getTaxAmount());
        $this->assertEquals('test2', $taxRateEntity->getCode());
        $this->assertEquals(2, $taxRateEntity->getId());
    }

}