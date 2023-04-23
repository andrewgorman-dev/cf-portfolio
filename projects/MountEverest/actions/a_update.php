<?php
// Connect to DB
require_once '../includes/db_connect.inc.php';
require_once  'file_upload.php';

if ($_POST) {
    $loc = $_POST['location_name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];
    $id = $_POST['id'];
    $uploadError = "";

    $picture = file_upload($_FILES['picture']); //file_upload() called  
    if ($picture->error === 0) {
        ($_POST["picture"] == "everest.jpeg") ?: unlink("../img/$_POST[picture]");
        $sql = "UPDATE locations SET location_name = '$loc', price = $price, description = '$desc', latitude = $lat, longitude = $lng, picture = '$picture->fileName' WHERE loc_id = {$id};";
    } else {
        // echo ($picture->error);
        $sql = "UPDATE locations SET location_name = '$loc', price = $price, description = '$desc', latitude = $lat, longitude = $lng WHERE loc_id = {$id};";
    }
    if (mysqli_query($connect, $sql)) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
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
    <title>Update Tour</title>
    <link rel="shortcut icon" href="../img/everest.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once '../includes/bootstrap_css.inc.php'; ?>
    <!-- Additional sass -->
    <link rel="stylesheet" href="../sass/main.css">
</head>

<body>
    <div class="a_update-container">
        <div class="p-3">
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../update.php?id=<?= $id; ?>'><button class="btn btn-warning" type='button'>Back </button></a>
            <a href='../index.php'><button class="btn btn-success" type='button'>Home </button></a>
        </div>
    </div>
    <!-- Bootstrap js cdn -->
    <?php require_once '../includes/bootstrap_js.inc.php'; ?>
</body>

</html>