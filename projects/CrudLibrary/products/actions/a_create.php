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

// import necessary service files
require_once '../../includes/db_connect.inc.php';
require_once '../../includes/file_upload.inc.php';

if ($_POST) {
    $title = $_POST['title'];
    $isbn = $_POST['isbn'];
    $description = $_POST['description'];
    $media_type = $_POST['media_type'];
    $author_name = $_POST['author_name'];
    $status = $_POST['status'];
    $publication_date = $_POST['publication_date'];
    $publisher = $_POST['publisher'];
    // $publisher = (int)$publisher;
    $uploadError = "";

    echo $publisher;

    // NEED TO CONVERT STRING TO INTEGER (NO WE DON'T!!)
    // echo gettype($publisher);
    // echo $publisher;
    // $publisher = (int)$publisher;
    // echo gettype($publisher);
    // echo $publisher;

    // call function from file_upload.php service file
    $picture = file_upload($_FILES['picture'], 'product'); // Now two arguments sent to file_upload.php
    // var_dump($_FILES['picture'], 'product);

    // Query now needs to be brought into an if statement to check for a publisher (supplier)
    if ($publisher == 'none') {
        $sql = "INSERT INTO media_items (title, pic, isbn, description, media_type, author_name, publication_date, status, fk_publisher_id)  
            VALUES ('$title', '$picture->fileName', $isbn, '$description', '$media_type', '$author_name', '$publication_date', '$status', null);";
    } else {
        $sql = "INSERT INTO media_items (title, pic, isbn, description, media_type, author_name, publication_date, status, fk_publisher_id)  
            VALUES ('$title', '$picture->fileName', $isbn, '$description', '$media_type', '$author_name', '$publication_date', '$status', $publisher);";
    }

    if (mysqli_query($connect, $sql)) {
        $class = "success";
        $message = "The entry below successfully added <br>
                    <table>
                        <tr>
                            <td>$title</td>
                            <td>$media_type</td>
                            <td>$isbn</td>
                            <td>$publication_date</td>
                            <td>$author_name</td>
                            <td>$description</td>
                            <td>$status</td>
                            <td>$publisher</td>
                        </tr>
                    </table>
                    <hr>";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : "";
    } else {
        $class = "danger";
        $message = "Error creating record. Try again. " . $connect->error;
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : "";
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
    <?php require_once '../../includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="../../sass/prod_styles.css">
    <title>Update</title>
</head>

<body>
    <div class="container create-request-container w-75 m-auto border shadow-lg mt-5 p-3">
        <div class="mt-3 mb-3">
            <h1 class="text-light">Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?= ($message) ?? ""; ?></p>
            <p><?= ($uploadError) ?? ""; ?></p>
            <a href="../product_index.php">
                <button class="btn btn-outline-primary" type="button">Home</button>
            </a>
        </div>
    </div>
    <!-- Javascript -->
    <!-- Bootstrap js -->
    <?php require_once '../../includes/bootstrap_js.inc.php' ?>
</body>

</html>