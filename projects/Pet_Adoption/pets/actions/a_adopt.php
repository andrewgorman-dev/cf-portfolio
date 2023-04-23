<?php
session_start();

if (isset($_SESSION['user']) != "") {
    $user_id = $_SESSION['user'];
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../../includes/db_connect.inc.php';
require_once '../../includes/file_upload.inc.php';

if ($_POST) {
    $pet_id = $_POST['id'];
    $sql = "INSERT INTO pet_adoption (fk_user_id, fk_pet_id) VALUES ($user_id, $pet_id);";
    $sql2 = "UPDATE `animals` SET `status` = 'reserved' WHERE `animals`.`pet_id` = $pet_id;";
    mysqli_query($connect, $sql2);

    if (mysqli_query($connect, $sql)) {
        // $message = "Congratulations on adopting your pet";
        header("location: ../your_pets.php");
    } else {
        header("location: ../error.php");
    }
    mysqli_close($connect);
}