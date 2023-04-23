<?php

session_start();
require_once '../includes/db_connect.inc.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// Query pet_adoption table
$sql = "SELECT * FROM pet_adoption JOIN animals ON pet_adoption.fk_pet_id = animals.pet_id";
$result = mysqli_query($connect, $sql);
$tbody = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "<tr>
                    <td>
                        <img class='img-thumbnail' src='../pictures/" . $row['picture'] . "'</td>
                    <td>" . $row['pet_name'] . "</td>
                    <td>" . $row['location'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['size'] . "</td>
                    <td>" . $row['age'] . "</td>
                    <td>" . $row['hobbies'] . "</td>
                    <td><i>" . $row['breed'] . "</i></td>
                    <td>
                        <a href='show.php?id=" . $row['pet_id'] . "'>
                            <button class='m-1 btn btn-info btn-sm mb-1 border-dark' type='button'>Show Details</button>
                        </a>
                    </td>
                </tr>";
    };
} else {
    $tbody = "<tr><td colspan='9'><center>No Data Available </center></td></tr>";
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>CR11 Your adoptions</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="pictures/pet-logo.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once '../includes/bootstrap_css.inc.php'; ?>
    <!-- Additional Styles -->
    <link rel="stylesheet" href="../sass/main.css">

</head>

<body>
    <div class="home-container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <div class="brand-wrapper rounded d-flex justify-content-start align-items-center">
                    <a href="../home.php">
                        <img src="../pictures/pet-logo.jpeg" height="48" class="me-2" alt="">
                    </a>
                    <a class="navbar-brand text-light" href="../home.php">
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
                            <a class="nav-link" aria-current="page" href="../home.php">Home</a>
                        </li>
                        <!--  FOR USERS ONLY -->
                        <li class="nav-item">
                            <a class="nav-link active" href="pets/your_pets.php">Your Pets</a>
                        </li>
                        <!-- Logout nav-link -->
                        <li class="nav-item">
                            <a class="nav-link btn btn-dark border rounded" href="../logout.php?logout">Sign Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Table 1 All-->
        <div class="container m-auto mt-3 mb-3 tableContainer" id="allTable">
            <div class="table-header d-flex justify-content-between">
                <p class='h2 media-title mt-4'>Your Adopted Pets</p>

            </div>

            <table class='table table-striped table-secondary table-hover border fixed-table-body mt-2'>
                <thead>
                    <tr class="colTitles">
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Description</th>
                        <th scope="col">Size</th>
                        <th scope="col">Age (yrs)</th>
                        <th scope="col">Hobbies</th>
                        <th scope="col">Breed</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Display records from animals table -->
                    <?= $tbody; ?>
                </tbody>
            </table>
        </div>
        <div class="btnContainer d-flex justify-content-center">
            <!-- CREATE BTN FOR ADMIN HERE -->

            <!-- <p class='h2 media-title'>All Prospective Pets</p> -->
            <a href="../home.php" class="btn btn-outline-dark rounded mb-3">Home</a>
        </div>
    </div>
    <!-- Bootstrap js cdn -->
    <?php require_once '../includes/bootstrap_js.inc.php'; ?>
    </div>
</body>

</html>