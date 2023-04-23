<?php
function build_query_string(array $params)
{
    $query_string = http_build_query($params);
    //generates URL-encoded for a query string
    return $query_string;
}
function curl_get($url)
{
    $client = curl_init($url);
    //Initializes a new CURL and prepares for next step
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    //Set an option for a CURL transfer
    $response = curl_exec($client);
    //it executes the CURL and return a string
    curl_close($client);
    //Closes a CURL session and frees all resources.
    return $response;
}