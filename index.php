<?php
require __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google Sheets and PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_Sheets($client);
$range = 'A1:B8';
$spreadSheetId = '10Ykg87BEbiHlTLFEN9Y-JvrgdczUJ2QzItJEK6XBfUY';
$responce = $service->spreadsheets_values->get($spreadSheetId, $range);
$values = $responce->getValues();

if($values) {
    print_r($values);
} else {
    echo 'no data';
}

//Insert Data

$range = 'A1:B8';

$values = [
    ['https://yandex.ru', 'Yandex']
];

$body = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);

$params = [
    'valueInputOption' => 'RAW'
];

$input = [
    'insertDataOption' => 'INSERT_ROWS'
];

$result = $service->spreadsheets_values->append(
    $spreadSheetId,
    $range,
    $body,
    $params,
    $insert
);
