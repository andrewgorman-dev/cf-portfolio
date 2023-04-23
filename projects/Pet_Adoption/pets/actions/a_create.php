<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}

// import necessary service files
require_once '../../includes/db_connect.inc.php';
require_once '../../includes/file_upload.inc.php';


if ($_POST) {
    $name = $_POST['name'];
    $loc = $_POST['location'];
    $desc = $_POST['description'];
    $size = $_POST['size'];
    $age = $_POST['age'];
    $hob = $_POST['hobbies'];
    $breed = $_POST['breed'];
    $status = $_POST['status'];
    $species = $_POST['species'];
    $uploadError = '';
    //this function exists in the service file upload.
    $picture = file_upload($_FILES['picture'], 'pet');

    //checks if the species is undefined and insert null in the DB
    $sql = "INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
    VALUES ('$name', '$picture->fileName', '$loc', '$desc', '$size', $age, '$hob', '$breed', '$status', '$species');";

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $name </td>
            <td> $loc </td>
            <td> $desc </td>
            <td> $size </td>
            <td> $age </td>
            <td> $hob </td>
            <td> $breed </td>
            <td> $status </td>
            <td> $species </td>
            </tr></table><hr>";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>CR11 Add new pet</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="../../pictures/pet-logo.jpeg" type="image/x-icon">
    <?php require_once '../../includes/bootstrap_css.inc.php' ?>
</head>

<body>
    <div class="container addedPet">
        <div class="mt-3 mb-3">
            <h1>Add Pet request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../../dashboard.php'><button class="btn btn-outline-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>