<?php

namespace alexshadie\geo;

class CountryBuilder
{
    /** @var int */
    private $countryId;

    /** @var string */
    private $countryName;

    /** @var string */
    private $countryCode2;

    /** @var string */
    private $countryCode3;

    /** @var string */
    private $countryNumber;

    public static function from(Country $src): CountryBuilder
    {
        $builder = new CountryBuilder();
        $builder->setCountryId($src->getCountryId());
        $builder->setCountryName($src->getCountryName());
        $builder->setCountryCode2($src->getCountryCode2());
        $builder->setCountryCode3($src->getCountryCode3());
        $builder->setCountryNumber($src->getCountryNumber());
        return $builder;
    }

    public function setCountryId(int $countryId): CountryBuilder
    {
        $this->countryId = $countryId;
        return $this;
    }

    public function setCountryName(string $countryName): CountryBuilder
    {
        $this->countryName = $countryName;
        return $this;
    }

    public function setCountryCode2(string $countryCode2): CountryBuilder
    {
        $this->countryCode2 = $countryCode2;
        return $this;
    }

    public function setCountryCode3(string $countryCode3): CountryBuilder
    {
        $this->countryCode3 = $countryCode3;
        return $this;
    }

    public function setCountryNumber(string $countryNumber): CountryBuilder
    {
        $this->countryNumber = $countryNumber;
        return $this;
    }

    public function create(): Country
    {
        return new Country(
            $this->countryId,
            $this->countryName,
            $this->countryCode2,
            $this->countryCode3,
            $this->countryNumber
        );
    }

}
