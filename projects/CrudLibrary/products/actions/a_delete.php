<?php
// check the session redirect as necessary
session_start();

// if (isset($_SESSION['user']) != "") {
//     header("Location: ../home.php");
//     exit;
// }
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

//import services
require_once '../../includes/db_connect.inc.php';

if ($_POST) {
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    ($picture == "picture.jpeg") ?: unlink("../../pictures/$picture");

    $sql = "DELETE FROM media_items WHERE id = {$id}";
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "Successfully Deleted!";
    } else {
        $class = "danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
    }
    mysqli_close($connect);
} else {
    header("location: ../product_error.php");
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Delete Media Item</title>
    <?php require_once '../../includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="../../sass/prod_styles.css">
</head>

<body>
    <div class="container m-auto deleted-container">
        <div class="mt-3 mb-3 m-auto">
            <h1 class="text-light">Delete request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?= $message; ?></p>
            <a href='../product_index.php'>
                <button class="btn btn-success" type='button'>Home</button>
            </a>
        </div>
    </div>
    <!-- Bootstrap js -->
    <?php require_once '../../includes/bootstrap_js.inc.php' ?>
</body>

</html>