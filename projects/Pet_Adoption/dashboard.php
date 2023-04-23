<?php
session_start();
// Import service files
require_once 'includes/db_connect.inc.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

// recognize admin
$id = $_SESSION['adm'];
$sql0 = "SELECT * FROM user WHERE id=" . $id;
$result0 = mysqli_query($connect, $sql0);
$row0 = $result0->fetch_array(MYSQLI_ASSOC);
$admfName = $row0['first_name'];
$admlName = $row0['last_name'];
$admName = $admfName . ' ' . $admlName;


// Queries
$sql = "SELECT * FROM animals";
$result = mysqli_query($connect, $sql);
$tbody = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "<tr>
                    <td>
                        <img class='img-thumbnail' src='pictures/" . $row['picture'] . "'</td>
                    <td>" . $row['pet_name'] . "</td>
                    <td>" . $row['location'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['size'] . "</td>
                    <td>" . $row['age'] . "</td>
                    <td>" . $row['hobbies'] . "</td>
                    <td><i>" . $row['breed'] . "</i></td>
                    <td>
                        <a href='pets/show.php?id=" . $row['pet_id'] . "'>
                            <button class='m-1 btn btn-info btn-sm mb-1 border-dark' type='button'>Show Details</button>
                        </a>
                        <br/>
                        <a href='pets/update.php?id=" . $row['pet_id'] . "'>
                            <button class='btn btn-primary btn-sm mb-1 border-dark' type='button'>Update</button>
                        </a>
                        <br/>
                        <a href='pets/delete.php?id=" . $row['pet_id'] . "'>
                            <button class='btn btn-danger btn-sm border-dark' type='button'>Delete</button>
                        </a>
                    </td>
                </tr>";
    };
} else {
    $tbody = "<tr><td colspan='9'><center>No Data Available </center></td></tr>";
}

// Filter by age query
$sql2 = "SELECT * FROM animals WHERE age > 8;";
$result2 = mysqli_query($connect, $sql2);
$tbody2 = "";

if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $tbody2 .= "<tr>
                    <td>
                        <img class='img-thumbnail' src='pictures/" . $row['picture'] . "'</td>
                    <td>" . $row['pet_name'] . "</td>
                    <td>" . $row['location'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['size'] . "</td>
                    <td>" . $row['age'] . "</td>
                    <td>" . $row['hobbies'] . "</td>
                    <td><i>" . $row['breed'] . "</i></td>
                    <td>
                        <a href='pets/show.php?id=" . $row['pet_id'] . "'>
                            <button class='m-1 btn btn-info btn-sm mb-1 border' type='button'>Show Details</button>
                        </a>
                        <br/>
                        <a href='pets/update.php?id=" . $row['pet_id'] . "'>
                            <button class='btn btn-primary btn-sm mb-1 border' type='button'>Update</button>
                        </a>
                        <br/>
                        <a href='pets/delete.php?id=" . $row['pet_id'] . "'>
                            <button class='btn btn-danger btn-sm border' type='button'>Delete</button>
                        </a>
                    </td>
                </tr>";
    };
} else {
    $tbody2 = "<tr><td colspan='9'><center>No Data Available </center></td></tr>";
}


mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>CR11 Home: Adopt-a-Pet</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="pictures/pet-logo.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once 'includes/bootstrap_css.inc.php'; ?>
    <!-- Additional Styles -->
    <link rel="stylesheet" href="sass/main.css">
</head>

<body>
    <div class="home-container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <div class="brand-wrapper rounded d-flex justify-content-start align-items-center">
                    <a href="#">
                        <img src="pictures/pet-logo.jpeg" height="48" class="me-2" alt="">
                    </a>
                    <a class="navbar-brand text-light" href="#">
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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Sort
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#seniors">Senior Animals</a></li>
                                <li><a class="dropdown-item" href="#">Admin Stuff</a></li>
                            </ul>
                        </li>
                        <!-- ADD PET (Admin Only) -->
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="pets/create.php">Add new pet</a>
                        </li>
                        <!-- Logout nav-link -->
                        <li class="nav-item">
                            <a class="nav-link btn btn-dark border rounded" href="logout.php?logout">Sign Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Welcome message -->
        <div class="container mt-3 p-3">
            <div class="hero p-3 rounded text-center">
                <img class="userImage rounded-circle" src="pictures//admavatar.png" alt="Admavatar">
                <p class="text-white">Hi <?php echo $admName; ?></p>
            </div>
            <a class="nav-link btn btn-dark border rounded w-25 m-auto" href="logout.php?logout">Sign Out</a>
            <a class="nav-link btn btn-warning border rounded w-25 m-auto"
                href="update.php?id=<?php echo $_SESSION['adm'] ?>">Update your profile</a>
        </div>
        <!-- Table 1 All-->
        <div class="container m-auto mt-3 mb-3 tableContainer" id="allTable">
            <div class="table-header d-flex justify-content-between">
                <p class='h2 media-title mt-4'>All Our Pets</p>
                <a href="#seniors" class="btn btn-outline-dark rounded mb-3 mt-4">View Senior Animals Only</a>
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
        <!-- Table 2 Senior  -->
        <div class="container m-auto mt-3 mb-3 tableContainer" id="seniors">
            <p class='h2 media-title mt-4'>Seniors Only</p>

            <table class='table table-striped table-dark table-hover border fixed-table-body'>
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
                    <!-- Display filtered records from animals table -->
                    <?= $tbody2; ?>
                </tbody>
            </table>
            <div class="btnContainer d-flex justify-content-between">
                <!-- CREATE BTN FOR ADMIN HERE -->
                <a href='pets/create.php'>
                    <button class='btn btn-success action-btn shadow-lg' type='button'>Add New Pet</button>
                </a>
                <!-- <p class='h2 media-title'>All Prospective Pets</p> -->
                <a href="#allTable" class="btn btn-outline-dark rounded mb-3">View All Pets</a>
            </div>
        </div>
        <!-- Bootstrap js cdn -->
        <?php require_once 'includes/bootstrap_js.inc.php'; ?>
    </div>
</body>

</html>