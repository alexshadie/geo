<?php


namespace alexshadie\geo;


interface CountryRepositoryInterface
{
    /**
     * Gets country by Id
     * @param int $countryId
     * @return Country|null
     */
    public function getCountryById(int $countryId): ?Country;

    /**
     * Gets country by 2-char or 3-char code
     * @param string $countryCode
     * @return Country|null
     */
    public function getCountryByCode(string $countryCode): ?Country;
}
