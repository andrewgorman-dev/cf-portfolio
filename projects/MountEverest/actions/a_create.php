<?php
// Connect to DB
require_once '../includes/db_connect.inc.php';
require_once  'file_upload.php';

if ($_POST) {
    $loc = $_POST['location_name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];
    $uploadError = "";
    $picture = file_upload($_FILES['picture']);

    $sql = "INSERT INTO locations (location_name, price, description, latitude, longitude, picture)
    VALUES ('$loc', $price, '$desc', $lat, $lng, '$picture->fileName');";

    if (mysqli_query($connect, $sql)) {
        $class = "success";
        $message = "The entry below was successfully created 
                    <br>
                    <table class='table w-50'>
                        <tr>
                            <td> $loc </td>
                            <td> $price </td>
                            <td> $desc </td>
                            <td> $lat </td>
                            <td> $lng </td>
                        </tr>
                    </table>
                    <hr>";
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Add Tour</title>
    <link rel="shortcut icon" href="../img/everest.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once '../includes/bootstrap_css.inc.php'; ?>
    <!-- Additional sass -->
    <link rel="stylesheet" href="../sass/main.css">
</head>

<body>
    <div class="container a_create-container">
        <div class="mt-3 mb-3">
            <h1 class="text-warning">Create request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index.php'>
                <button class="btn btn-success" type='button'>Home</button>
            </a>
        </div>
    </div>
    <!-- Bootstrap js cdn -->
    <?php require_once '../includes/bootstrap_js.inc.php'; ?>
</body>

</html>