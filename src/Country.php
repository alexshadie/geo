<?php

namespace alexshadie\geo;

class Country
{
    /**
     * @var int
     */
    private $countryId;

    /**
     * @var string
     */
    private $countryName;

    /**
     * @var string
     */
    private $countryCode2;

    /**
     * @var string
     */
    private $countryCode3;

    /**
     * @var string
     */
    private $countryNumber;

    public function __construct(int $countryId, string $countryName, string $countryCode2, string $countryCode3, string $countryNumber)
    {
        $this->countryId = $countryId;
        $this->countryName = $countryName;
        $this->countryCode2 = $countryCode2;
        $this->countryCode3 = $countryCode3;
        $this->countryNumber = $countryNumber;
    }

    public static function build(): CountryBuilder
    {
        return new CountryBuilder();
    }

    public function equals(Country $country): bool
    {
        return
            $this->getCountryId() == $country->getCountryId() &&
            $this->getCountryName() == $country->getCountryName() &&
            $this->getCountryCode2() == $country->getCountryCode2() &&
            $this->getCountryCode3() == $country->getCountryCode3() &&
            $this->getCountryNumber() == $country->getCountryNumber();
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function getCountryCode2(): string
    {
        return $this->countryCode2;
    }

    public function getCountryCode3(): string
    {
        return $this->countryCode3;
    }

    public function getCountryNumber(): string
    {
        return $this->countryNumber;
    }

}
