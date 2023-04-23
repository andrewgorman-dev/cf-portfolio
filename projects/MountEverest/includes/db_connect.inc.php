<?php

// $localhost = "127.0.0.1";
// $username = "root";
// $password = "";
// $dbname = "fswd14_cr12_mount_everest_andrew_gorman"; 

$localhost = "ftp.andrew.codefactory.live";
$username = "andrewco_andi";
$password = "dbH*und14";
$dbname = "andrewco_mount_everest";

// create connection
$connect = new mysqli($localhost, $username, $password, $dbname);

// check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} else {
    // echo "Successfully Connected to " . $dbname;
}