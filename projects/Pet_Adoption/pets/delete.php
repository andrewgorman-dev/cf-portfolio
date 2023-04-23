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
require_once '../includes/db_connect.inc.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE animals.pet_id = {$id};";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data["pet_name"];
        $pic = $data["picture"];
        $loc = $data["location"];
        $desc = $data["description"];
        $size = $data["size"];
        $age = $data["age"];
        $hob = $data["hobbies"];
        $breed = $data["breed"];
        $species = $data["species"];
        $status = $data["status"];
        if (strtolower($status) == 'available') {
            $class = "text-success";
            $status .= ' for adoption';
        } else if (strtolower($status) == 'reserved') {
            $class = "text-danger";
        } else {
            $class = "Availability information unavailable.";
        }
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Delete Pet Record</title>
    <?php require_once '../includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="../sass/main.css">
</head>

<body>
    <div class="container delete-container border rounded p-4 mt-5 text-light m-auto w-50">
        <fieldset>
            <legend class='h2 mb-3 m-auto'>Delete request
                <img class='img-thumbnail deleteImg ms-1' src='../pictures/<?php echo $pic ?>'
                    alt="<?php echo $name ?>">
            </legend>
            <!-- Table -->
            <h5>You have selected the pet record below:</h5>
            <table class="table w-75 mt-3">
                <tr>
                    <td>
                        <h2 class="text-light"><?php echo $name ?></h2>
                        <p class="text-light">
                            <?php echo 'Current residence: ' . $loc  ?>
                        </p>
                    </td>
                </tr>
            </table>
            <!-- Form -->
            <h3 class="mb-4">Do you really want to delete this pet record?</h3>
            <form action="actions/a_delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <input type="hidden" name="picture" value="<?php echo $pic ?>" />
                <button class="btn btn-danger" type="submit">Yes, delete it!</button>
                <a href="../dashboard.php">
                    <button class="btn btn-warning" type="button">No, go back!</button>
                </a>
            </form>
        </fieldset>
    </div>
    <!-- Bootstrap js -->
    <?php require_once '../includes/bootstrap_js.inc.php' ?>
</body>

</html>