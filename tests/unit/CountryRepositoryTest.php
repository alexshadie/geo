<?php

namespace alexshadie\geo;


use alexshadie\dbwrapper\DBInterface;
use PHPUnit\Framework\Constraint\RegularExpression;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CountryRepositoryTest extends TestCase
{
    /** @var DBInterface|MockObject */
    private $db;
    /** @var CountryRepository */
    private $repo;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->db = $this->getMockBuilder(DBInterface::class)
            ->getMock();
        $this->repo = new CountryRepository($this->db);
        parent::setUp();
    }

    public function testGetCountryByIdOk()
    {
        $this->db->expects($this->once())
            ->method('queryRow')
            ->with($this->anything(), ['countryId' => 77])
            ->willReturn([
                'country_id' => 77,
                'country_name' => 'Country',
                'country_code2' => 'CT',
                'country_code3' => 'CNT',
                'country_number' => '077',
            ]);
        $country = $this->repo->getCountryById(77);
        $this->assertEquals(77, $country->getCountryId());
        $this->assertEquals('Country', $country->getCountryName());
        $this->assertEquals('CT', $country->getCountryCode2());
        $this->assertEquals('CNT', $country->getCountryCode3());
        $this->assertEquals('077', $country->getCountryNumber());
    }

    public function testGetCountryByIdEmpty()
    {
        $this->db->expects($this->once())
            ->method('queryRow')
            ->with($this->anything(), ['countryId' => 78])
            ->willReturn(null);
        $country = $this->repo->getCountryById(78);
        $this->assertNull($country);
    }

    public function testGetCountryByCode2Ok()
    {
        $this->db->expects($this->once())
            ->method('queryRow')
            ->with(new RegularExpression('!`country_code2`!'), ['code' => 'CT'])
            ->willReturn([
                'country_id' => 77,
                'country_name' => 'Country',
                'country_code2' => 'CT',
                'country_code3' => 'CNT',
                'country_number' => '077',
            ]);
        $country = $this->repo->getCountryByCode('CT');
        $this->assertEquals(77, $country->getCountryId());
        $this->assertEquals('Country', $country->getCountryName());
        $this->assertEquals('CT', $country->getCountryCode2());
        $this->assertEquals('CNT', $country->getCountryCode3());
        $this->assertEquals('077', $country->getCountryNumber());
    }

    public function testGetCountryByCode3Ok()
    {
        $this->db->expects($this->once())
            ->method('queryRow')
            ->with(new RegularExpression('!`country_code3`!'), ['code' => 'CNT'])
            ->willReturn([
                'country_id' => 77,
                'country_name' => 'Country',
                'country_code2' => 'CT',
                'country_code3' => 'CNT',
                'country_number' => '077',
            ]);
        $country = $this->repo->getCountryByCode('CNT');
        $this->assertEquals(77, $country->getCountryId());
        $this->assertEquals('Country', $country->getCountryName());
        $this->assertEquals('CT', $country->getCountryCode2());
        $this->assertEquals('CNT', $country->getCountryCode3());
        $this->assertEquals('077', $country->getCountryNumber());
    }

    /**
     * @expectedException \alexshadie\geo\exception\GeoException
     * @expectedExceptionCode 9001
     * @expectedExceptionMessage Invalid country code
     */
    public function testGetCountryByCodeInvalidCode()
    {
        $this->db->expects($this->never())
            ->method('queryRow');

        $this->repo->getCountryByCode('C');
    }

    public function testGetCountryByCodeNoCountry()
    {
        $this->db->expects($this->once())
            ->method('queryRow')
            ->with(new RegularExpression('!`country_code2`!'), ['code' => 'NC'])
            ->willReturn(null);
        $country = $this->repo->getCountryByCode('NC');
        $this->assertNull($country);
    }


}
