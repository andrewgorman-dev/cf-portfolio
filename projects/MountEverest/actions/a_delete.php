<?php
// Connect to DB
require_once '../includes/db_connect.inc.php';

if ($_POST) {
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    ($picture == "everest.jpeg") ?: unlink("../img/$picture");

    $sql = "DELETE FROM locations WHERE loc_id = {$id}";
    if (mysqli_query($connect, $sql)) {
        $class = "success";
        $message = "Location successfully Deleted!";
    } else {
        $class = "danger";
        $message = "The location was not deleted due to: <br>"  . $connect->error;
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
    <div class="a_delete-container text-light">
        <div class="p-3">
            <h1>Delete request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?= $message; ?></p>
            <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
    <!-- Bootstrap js cdn -->
    <?php require_once '../includes/bootstrap_js.inc.php'; ?>
</body>

</html>