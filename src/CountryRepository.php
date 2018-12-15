<?php


namespace alexshadie\geo;


use alexshadie\dbwrapper\DBInterface;
use alexshadie\geo\exception\GeoException;

class CountryRepository implements CountryRepositoryInterface
{
    /** @var DBInterface */
    private $db;

    /**
     * CountryRepository constructor.
     * @param DBInterface $db
     */
    public function __construct(DBInterface $db)
    {
        $this->db = $db;
    }

    /**
     * @inheritdoc
     */
    public function getCountryById(int $countryId): ?Country
    {
        $row = $this->db->queryRow(
            "SELECT * FROM `geo_country` WHERE `country_id` = :countryId",
            [
                'countryId' => $countryId,
            ]
        );

        if (!$row) {
            return null;
        }

        return Country::build()
            ->setCountryId($row['country_id'])
            ->setCountryName($row['country_name'])
            ->setCountryCode2($row['country_code2'])
            ->setCountryCode3($row['country_code3'])
            ->setCountryNumber($row['country_number'])
            ->create();
    }

    /**
     * @inheritDoc
     */
    public function getCountryByCode(string $countryCode): ?Country
    {
        $field = null;
        if (strlen($countryCode) == 2) {
            $field = 'country_code2';
        } elseif (strlen($countryCode) == 3) {
            $field = 'country_code3';
        } else {
            throw new GeoException("Invalid country code", 9001);
        }

        $row = $this->db->queryRow(
            "SELECT * FROM `geo_country` WHERE `{$field}` = :code",
            [
                'code' => $countryCode,
            ]
        );

        if (!$row) {
            return null;
        }

        return Country::build()
            ->setCountryId($row['country_id'])
            ->setCountryName($row['country_name'])
            ->setCountryCode2($row['country_code2'])
            ->setCountryCode3($row['country_code3'])
            ->setCountryNumber($row['country_number'])
            ->create();
    }


}