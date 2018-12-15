<?php


namespace alexshadie\geo;


interface CountryServiceInterface
{
    /**
     * @param int $countryId
     * @return Country|null
     */
    public function getCountryById(int $countryId): ?Country;

    /**
     * @param string $countryCode
     * @return Country|null
     */
    public function getCountryByCode(string $countryCode): ?Country;
}