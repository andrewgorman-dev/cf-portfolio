<?php
// check the session redirect as necessary
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

//import services
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
    $id = $_POST['id'];
    //this function exists in the service file upload.
    $picture = file_upload($_FILES['picture'], 'pet');

    if ($picture->error === 0) {
        ($_POST["picture"] == "pet.jpeg") ?: unlink("../../pictures/$_POST[picture]");
        $sql = "UPDATE animals SET pet_name = '$name', picture = '$picture->fileName', location = $loc, description = '$desc', size = '$size', age = $age, hobbies = '$hob', breed = '$breed', status = '$status', species = '$species' WHERE pet_id = {$id}";
    } else {
        $sql = "UPDATE animals SET pet_name = '$name', picture = '$picture->fileName', location = $loc, description = '$desc', size = '$size', age = $age, hobbies = '$hob', breed = '$breed', status = '$status', species = '$species' WHERE pet_id = {$id}";
    }
    if (mysqli_query($connect, $sql)) {
        $class = "success";
        $message = "The pet's record was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while updating pet record : <br>" . mysqli_connect_error();
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Update</title>
    <?php require_once '../../includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="../../sass/main.css">
</head>

<body>
    <div class="container m-auto border a_update-container">
        <div class="mt-3 mb-3 m-auto">
            <h1 class="text-dark">Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../update.php?id=<?= $id; ?>'>
                <button class="btn btn-outline-warning" type='button'>Back</button>
            </a>
            <a href='../../dashboard.php'>
                <button class="btn btn-outline-success" type='button'>Home</button>
            </a>
        </div>
    </div>
    <!-- Bootstrap js -->
    <?php require_once '../../includes/bootstrap_js.inc.php' ?>
</body>

</html>