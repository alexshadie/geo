<?php
include __DIR__ . "/../vendor/autoload.php";

$config = @include(__DIR__ . "/../config/config.php");

$mysql = new \alexshadie\dbwrapper\Mysql(
    new PDO($config['db.dsn'], $config['db.user'], $config['db.password'])
);

$src = fopen(__DIR__ . '/country-codes_csv.csv', 'r'); // From https://datahub.io/core/country-codes#resource-country-codes_zip
$header = fgetcsv($src);
$countries = [];

while ($row = fgetcsv($src)) {
    if (!$row) {
        continue;
    }
    $row = array_combine($header, $row);

    $countries[] = [
        'country_id' => intval($row['ISO3166-1-numeric']),
        'country_name' => $row['CLDR display name'],
        'country_code2' => $row['ISO3166-1-Alpha-2'],
        'country_code3' => $row['ISO3166-1-Alpha-3'],
        'country_number' => $row['ISO3166-1-numeric'],
    ];
}

foreach ($countries as $country) {
    if ($country['country_number'] === '') {
        continue;
    }
    $mysql->insert('geo_country', $country);
}