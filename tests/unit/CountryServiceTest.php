<?php

namespace alexshadie\geo;


use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CountryServiceTest extends TestCase
{
    /** @var CountryRepositoryInterface|MockObject */
    private $repository;
    /** @var CountryService */
    private $service;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->repository = $this->getMockBuilder(CountryRepositoryInterface::class)
            ->getMock();
        $this->service = new CountryService($this->repository);
        parent::setUp();
    }

    public function testGetCountryById()
    {
        $this->repository->expects($this->once())
            ->method('getCountryById')
            ->with(11)
            ->willReturn($this->getCountryStub());
        $country = $this->service->getCountryById(11);
        $this->assertTrue($country->equals($this->getCountryStub()));
    }

    private function getCountryStub()
    {
        return new Country(1, 'Country 1', 'CT', 'CNT', '001');
    }

    public function testGetCountryByIdNotFound()
    {
        $this->repository->expects($this->once())
            ->method('getCountryById')
            ->with(11)
            ->willReturn(null);
        $country = $this->service->getCountryById(11);
        $this->assertNull($country);
    }

    public function testGetCountryByCode()
    {
        $this->repository->expects($this->once())
            ->method('getCountryByCode')
            ->with('CT')
            ->willReturn($this->getCountryStub());
        $country = $this->service->getCountryByCode('CT');
        $this->assertTrue($country->equals($this->getCountryStub()));
    }

    public function testGetCountryByCodeNotFound()
    {
        $this->repository->expects($this->once())
            ->method('getCountryByCode')
            ->with('CT')
            ->willReturn(null);
        $country = $this->service->getCountryByCode('CT');
        $this->assertNull($country);
    }
}
