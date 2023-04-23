<?php

$localhost = "ftp.andrew.codefactory.live";
$username = "andrewco_andi";
$password = "dbH*und14";
$dbname = "andrewco_crud_library_login";

// $localhost = "127.0.0.1";
// $username = "root";
// $password = "";
// $dbname = "api_crud_library_login";

// create connection
$connect = new  mysqli($localhost, $username, $password, $dbname);

// check connection
// if ($connect->connect_error) {
//     die("Connection failed: " . $connect->connect_error);
// } else {
//     echo "Successfully Connected to " . $dbname;
// }