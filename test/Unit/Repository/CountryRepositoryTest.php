<?php declare(strict_types=1);

namespace Taxation\Test\Unit\Repository;

use PHPUnit\Framework\TestCase;
use Taxation\Repository\CountryRepository;

class UserServiceTest extends TestCase
{
    /** @var CountryRepository */
    private $subject;

    protected function setUp()
    {
        $this->subject = new CountryRepository();
    }

    public function testValidData()
    {
        $country = $this->subject->getByName('Germany');
        $this->assertInstanceOf('\Taxation\Entity\Country', $country);
        $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $country->getStates());
        $this->assertEquals('Germany', $country->getName());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Country sfsdsd was not found
     */
    public function testThrowsExceptionOnInvalidCountry()
    {
        $this->subject->getByName('sfsdsd');
    }
}