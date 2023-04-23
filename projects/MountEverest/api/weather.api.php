<?php

require_once '../includes/db_connect.inc.php';
if (isset($_POST['lat']) && isset($_POST['lng'])) {

    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
};

require_once 'weather_REST.api.php';
// $coordinates = $lat . "," . $lng;
$url = "https://api.darksky.net/forecast/e329256a741df2bcccffedd3600287c2/" . $lat . "," . $lng . "?exclude=minutely,hourly,daily,alerts,flags";
$result = curl_get($url);

$weather = json_decode($result); //it turns the json into an object
$fahrenheit = $weather->currently->temperature; //fetch the value from the temperature option

$celsius = round(($fahrenheit - 32) * (5 / 9), 2); //convert fahrenheit into celsius

echo "
<div class='card weatherCard text-center m-auto text-white bg-info p-2' style='width: 18rem; font-size: 1.2rem'>
    <p class='card-title'> {$weather->timezone} </p>
    <div class='card-body border rounded'>
        <p class='card-text text-light'> {$weather->currently->summary} </p>
        <p class='card-text text-light'>{$celsius}°C</p>
        <p class='card-text text-light'>{$fahrenheit}°F</p>
    </div>
</div>";