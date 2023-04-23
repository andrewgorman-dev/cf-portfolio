<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');

require_once '../includes/db_connect.inc.php';
require_once 'toolbox.api.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM media_items WHERE id = " . $_GET['id'] . ";";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        response(200, 'Data fetched', $row);
    } else {
        response(400, "error: " . mysqli_error($connect));
    }
}