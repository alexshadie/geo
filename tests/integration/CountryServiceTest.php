<?php

namespace alexshadie\geo;


use alexshadie\dbwrapper\Mysql;
use PHPUnit\Framework\TestCase;

class CountryServiceIntegrationTest extends TestCase
{
    /** @var CountryService */
    private $service;
    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $config = include(__DIR__ . "/../../config/config.php");
        $pdo = new \PDO($config['db.dsn'], $config['db.user'], $config['db.password']);
        $mysql = new Mysql($pdo);
        $repository = new CountryRepository($mysql);
        $this->service = new CountryService($repository);
        parent::setUp();
    }

    public function testGetCountryByIdOk()
    {
        $country = $this->service->getCountryById(31);
        $this->assertEquals(31, $country->getCountryId());
        $this->assertEquals('Azerbaijan', $country->getCountryName());
        $this->assertEquals('AZ', $country->getCountryCode2());
        $this->assertEquals('AZE', $country->getCountryCode3());
        $this->assertEquals('031', $country->getCountryNumber());
    }

    public function testGetCountryByIdNotFound()
    {
        $country = $this->service->getCountryById(1);
        $this->assertNull($country);
    }

    public function testGetCountryByCode2()
    {
        $country = $this->service->getCountryByCode('AZ');
        $this->assertEquals(31, $country->getCountryId());
        $this->assertEquals('Azerbaijan', $country->getCountryName());
        $this->assertEquals('AZ', $country->getCountryCode2());
        $this->assertEquals('AZE', $country->getCountryCode3());
        $this->assertEquals('031', $country->getCountryNumber());
    }


    public function testGetCountryByCode3()
    {
        $country = $this->service->getCountryByCode('AZE');
        $this->assertEquals(31, $country->getCountryId());
        $this->assertEquals('Azerbaijan', $country->getCountryName());
        $this->assertEquals('AZ', $country->getCountryCode2());
        $this->assertEquals('AZE', $country->getCountryCode3());
        $this->assertEquals('031', $country->getCountryNumber());
    }

    /**
     * @expectedException \alexshadie\geo\exception\GeoException
     * @expectedExceptionCode 9001
     * @expectedExceptionMessage Invalid country code
     */
    public function testGetCountryByCodeInvalidCode()
    {
        $this->service->getCountryByCode('A');
    }

    public function testGetCountryByCodeNotFound()
    {
        $country = $this->service->getCountryByCode('AAA');
        $this->assertNull($country);
    }
}
