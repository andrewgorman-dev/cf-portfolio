<?php
session_start();


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
// import service files
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
    <title>CR11 <?= $name . "'s " ?>Details</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="../pictures/pet-logo.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once '../includes/bootstrap_css.inc.php'; ?>
    <!-- Additional Styles -->
    <link rel="stylesheet" href="../sass/main.css">
</head>

<body>
    <div class="show-container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <div class="brand-wrapper rounded d-flex justify-content-start align-items-center">
                    <!-- Dashboard for Admin -->
                    <a href='<?php if (isset($_SESSION['adm'])) {
                                    echo "../dashboard.php";
                                } else {
                                    echo "../home.php";
                                } ?>'>
                        <img src="../pictures/pet-logo.jpeg" height="48" class="me-2" alt="">
                    </a>
                    <a class="navbar-brand text-light" href='<?php if (isset($_SESSION['adm'])) {
                                                                    echo "../dashboard.php";
                                                                } else {
                                                                    echo "../home.php";
                                                                } ?>'>
                        Adopt a Pet
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <!-- ADMIN TO DASHBOARD -->
                            <a class="nav-link" aria-current="page" href='<?php if (isset($_SESSION['adm'])) {
                                                                                echo "../dashboard.php";
                                                                            } else {
                                                                                echo "../home.php";
                                                                            } ?>'>Home</a>
                        </li>
                        <li class="nav-item">
                            <!-- ADD PET NAME WITH PHP -->
                            <a class="nav-link active" aria-current="page" href="#"><?= $name . "'s " ?>Details</a>
                        </li>
                        <!-- ADD PET (Admin Only) -->
                        <?php
                        if (isset($_SESSION["adm"])) {
                            echo "<li class='nav-item'>
                                    <a class='nav-link' aria-current='page' href='create.php'>Add new pet</a>
                                </li>";
                        }
                        ?>
                        <!--  FOR USERS ONLY -->
                        <?php if (isset($_SESSION["user"])) {
                            echo "<li class='nav-item'>
                                    <a class='nav-link' href='your_pets.php'>Your Pets</a>
                                </li>";
                        } ?>

                    </ul>
                </div>
            </div>
        </nav>
        <!--  Display Card -->
        <div class="container w-75 mt-3">
            <div class="card m-auto border rounded dispCard shadow" style="max-width: 70vw;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="../pictures/<?= $pic ?>" class="img-fluid img-thumbnail rounded-start cardImg"
                            alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $name ?></h5>
                            <p class="card-text"><?= $name . ' is your ' . $desc ?>
                            </p>
                            <p class="card-text"><?= $name . ' loves: ' . $hob ?></p>
                            <p class="card-text"><?= $name . ' currently resides at: ' . $loc ?></p>
                            <p class="card-text"><?= $name . ' is a ' . $species ?> of the breed/genus:
                                <i><?= $breed ?></i>
                            </p>
                            <hr />
                            <h6 class="<?= $class ?>"><?= $name . ' is currently ' . strtolower($status) ?></h6>

                        </div>
                    </div>
                </div>
            </div>
            <!-- BUTTONS -->
            <div class="container w-75 showBtns">
                <div class='mt-5 mb-5 d-flex justify-content-evenly'>
                    <!-- CREATE IS ADMIN ONLY -->
                    <?php if (isset($_SESSION["adm"])) {
                        echo "<a href='create.php'>
                                <button class='btn btn-outline-primary action-btn p-3 shadow mb-3' type='button'>Add New
                                Pet</button>
                            </a>";
                    } ?>

                    <!-- Adopt IS USER ONLY Use hidden form for id -->
                    <?php if (isset($_SESSION["user"])) {
                        if ($status != 'reserved') {
                            echo "<form action='actions/a_adopt.php' method='POST' enctype='multipart/  form-data'>
                                    <input type='hidden' name='id' value='$id' />
                                    <button type='submit' class='btn btn-outline-success p-3 shadow'>Take $name home</button>
                                </form>";
                        }
                    } ?>

                    <!-- DASHBOARD instead of HOME FOR ADMIN -->
                    <a href="../home.php">
                        <button class='btn btn-outline-info action-btn p-3 shadow mb-3' type="button">Back to All
                            Media
                            Items</button>
                    </a>
                </div>
            </div>
            <!-- Bootstrap js cdn -->
            <?php require_once '../includes/bootstrap_js.inc.php'; ?>
        </div>
</body>

</html>