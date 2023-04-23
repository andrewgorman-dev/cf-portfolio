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
    $title = $_POST['title'];
    $description = $_POST['description'];
    $media_type = $_POST['media_type'];
    $author_name = $_POST['author_name'];
    $isbn = $_POST['isbn'];
    $publication_date = $_POST['publication_date'];
    $status = $_POST['status'];
    $uploadError = "";
    $id = $_POST['id'];
    $publisher = $_POST['publisher'];
    //variable for upload pictures errors is initialized
    $picture = file_upload($_FILES['picture']); // returns $result object

    if ($picture->error === 0) {
        ($_POST["picture"] == "picture.jpeg") ?: unlink("../../pictures/$_POST[picture]");
        $sql = "UPDATE media_items SET title = '$title', pic = '$picture->fileName', isbn = $isbn, description = '$description', media_type = '$media_type', author_name = '$author_name', publication_date = '$publication_date', status = '$status', fk_publisher_id = $publisher WHERE id = {$id}";
    } else {
        $sql = "UPDATE media_items SET title = '$title', pic = '$picture->fileName', isbn = $isbn, description = '$description', media_type = '$media_type', author_name = '$author_name', publication_date = '$publication_date', status, = '$status', fk_publisher_id = $publisher WHERE id = {$id}";
    }
    if (mysqli_query($connect, $sql) === TRUE) {
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
    header("location: ../product_error.php");
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
    <link rel="stylesheet" href="../../sass/prod_styles.css">
</head>

<body>
    <div class="container m-auto border a_update-prod">
        <div class="mt-3 mb-3 m-auto">
            <h1 class="text-light">Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../product_update.php?id=<?= $id; ?>'>
                <button class="btn btn-outline-warning" type='button'>Back</button>
            </a>
            <a href='../product_index.php'>
                <button class="btn btn-outline-success" type='button'>Home</button>
            </a>
        </div>
    </div>
    <!-- Bootstrap js -->
    <?php require_once '../../includes/bootstrap_js.inc.php' ?>
</body>

</html>