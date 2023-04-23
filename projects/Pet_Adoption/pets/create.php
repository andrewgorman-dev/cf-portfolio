<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

//  Import service file
require_once '../includes/db_connect.inc.php';

// Query to bring in species for dropdown menu
$species = "";
$sql = "SELECT * FROM animals;";
$res = mysqli_query($connect, $sql);
while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    $species .= "<option value={$row['pet_id']}>{$row['species']}</option>";
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>CR11 Add new pet</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="../pictures/pet-logo.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once '../includes/bootstrap_css.inc.php'; ?>
    <!-- Additional Styles -->
    <link rel="stylesheet" href="../sass/main.css">
    <style>
    th {
        vertical-align: middle;
    }
    </style>
</head>

<body>
    <div class="create-container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <div class="brand-wrapper rounded d-flex justify-content-start align-items-center">
                    <a href="../dashboard.php">
                        <img src="../pictures/pet-logo.jpeg" height="48" class="me-2" alt="">
                    </a>
                    <a class="navbar-brand text-light" href="../dashboard.php">
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
                            <a class="nav-link" aria-current="page" href="../dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <!-- ADD PET (Admin Only)) -->
                            <a class="nav-link active" aria-current="page" href="#">Add new pet</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- CREATE FORM -->
        <div class="container w-75 m-auto border-light p-4">
            <form action="actions/a_create.php" method="POST" enctype="multipart/form-data">
                <h2 class="w-75 m-auto mt-3 mb-3 text-dark createTitle">Add New Pet</h2>
                <table class='table table-dark table-hover m-auto w-75 createTable rounded border-light'>
                    <!-- Name -->
                    <tr>
                        <th>Name of Pet</th>
                        <td>
                            <input class='form-control' type="text" name="name" placeholder="Pet's name" />
                        </td>
                    </tr>
                    <!-- species (dropdown) -->
                    <tr>
                        <th>Species</th>
                        <td>
                            <select class="form-select" name="species" aria-label="Default select example">
                                <?php echo $species; ?>
                                <option selected value="none">None selected</option>
                            </select>
                        </td>
                    </tr>
                    <!-- $age -->
                    <tr>
                        <th>Age (years)</th>
                        <td>
                            <input class='form-control' type="number" name="age" placeholder="Human years please! :-)"
                                step="any" />
                        </td>
                    </tr>
                    <!-- $description -->
                    <tr>
                        <th>Description</th>
                        <td>
                            <input class='form-control' type="text" name="description"
                                placeholder="Brief description" />
                        </td>
                    </tr>
                    <!-- $hob -->
                    <tr>
                        <th>Hobbies</th>
                        <td>
                            <input class='form-control' type="text" name="hobbies" placeholder="E.g Going for walks" />
                        </td>
                    </tr>
                    <!-- $size -->
                    <tr>
                        <th>Size</th>
                        <td>
                            <input class='form-control' type="text" name="size" placeholder="E.g large or small" />
                        </td>
                    </tr>
                    <!-- $breed -->
                    <tr>
                        <th>Breed/Genus</th>
                        <td>
                            <input class='form-control' type="text" name="breed"
                                placeholder="E.g Husky or canis linnaeus" />
                        </td>
                    </tr>
                    <!-- $loc -->
                    <tr>
                        <th>Location</th>
                        <td>
                            <input class='form-control' type="text" name="location"
                                placeholder="E.g 34 Praterstrasse" />
                        </td>
                    </tr>
                    <!-- $status -->
                    <tr>
                        <th>Status</th>
                        <td>
                            <input class='form-control' type="text" name="status"
                                placeholder="E.g Available or Reserved" />
                        </td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            <input class='form-control' type="file" name="picture" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <button class='btn btn-primary action-btn' type="submit">Add pet</button>
                        </td>
                        <td>
                            <a href="../dashboard.php">
                                <button class='btn border btn-outline-success text-light' type="button">Home</button>
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- Bootstrap js cdn -->
        <?php require_once '../includes/bootstrap_js.inc.php'; ?>
    </div>
</body>

</html>