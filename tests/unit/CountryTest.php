<?php

namespace alexshadie\geo;

use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{

    public function testBuild()
    {
        $c = new Country(1, 'Country 1', 'CT', 'CNT', '001');
        $this->assertEquals(1, $c->getCountryId());
        $this->assertEquals('Country 1', $c->getCountryName());
        $this->assertEquals('CT', $c->getCountryCode2());
        $this->assertEquals('CNT', $c->getCountryCode3());
        $this->assertEquals('001', $c->getCountryNumber());

        $c = Country::build()
            ->setCountryId(1)
            ->setCountryName('Country 1')
            ->setCountryCode2('CT')
            ->setCountryCode3('CNT')
            ->setCountryNumber('001')
            ->create();

        $this->assertEquals(1, $c->getCountryId());
        $this->assertEquals('Country 1', $c->getCountryName());
        $this->assertEquals('CT', $c->getCountryCode2());
        $this->assertEquals('CNT', $c->getCountryCode3());
        $this->assertEquals('001', $c->getCountryNumber());

        $c = CountryBuilder::from($c)
            ->create();
        $this->assertEquals(1, $c->getCountryId());
        $this->assertEquals('Country 1', $c->getCountryName());
        $this->assertEquals('CT', $c->getCountryCode2());
        $this->assertEquals('CNT', $c->getCountryCode3());
        $this->assertEquals('001', $c->getCountryNumber());
    }

    public function testEquals()
    {
        $c = new Country(1, 'Country 1', 'CT', 'CNT', '001');
        $c1 = new Country(2, 'Country 1', 'CT', 'CNT', '001');
        $c2 = new Country(1, 'Country 2', 'CT', 'CNT', '001');
        $c3 = new Country(1, 'Country 1', 'CU', 'CNT', '001');
        $c4 = new Country(1, 'Country 1', 'CT', 'CNU', '001');
        $c5 = new Country(1, 'Country 1', 'CT', 'CNU', '002');

        $this->assertTrue($c->equals($c));
        $this->assertFalse($c->equals($c1));
        $this->assertFalse($c->equals($c2));
        $this->assertFalse($c->equals($c3));
        $this->assertFalse($c->equals($c4));
        $this->assertFalse($c->equals($c5));
        $this->assertFalse($c1->equals($c));
        $this->assertFalse($c2->equals($c));
        $this->assertFalse($c3->equals($c));
        $this->assertFalse($c4->equals($c));
        $this->assertFalse($c5->equals($c));
    }

}
