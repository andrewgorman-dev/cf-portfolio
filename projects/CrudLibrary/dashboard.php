<?php
session_start();
require_once 'includes/db_connect.inc.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$id = $_SESSION['adm'];

// Select Admin name to display
// $sql0 = "SELECT first_name, last_name FROM users WHERE status = 'adm';";
$sql0 = "SELECT * FROM users WHERE id=" . $id;
$result0 = mysqli_query($connect, $sql0);
$row0 = $result0->fetch_array(MYSQLI_ASSOC);
$admfName = $row0['first_name'];
$admlName = $row0['last_name'];
$admName = $admfName . ' ' . $admlName;

$status = 'adm';
$sql = "SELECT * FROM users WHERE status != '$status'";
$result = mysqli_query($connect, $sql);

//this variable will hold the body for the table
$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
                    <td>
                        <img class='img-thumbnail user-table-img rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . ">
                    </td>
                    <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
                    <td>" . $row['date_of_birth'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>
                        <a href='update.php?id=" . $row['id'] . "'>
                            <button class='btn btn-primary btn-sm mb-1' type='button'>Edit</button>
                        </a>
                        <a href='delete.php?id=" . $row['id'] . "'>
                        <button class='btn btn-danger btn-sm' type='button'>Delete</button>
                        </a>
                    </td>
                </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm-DashBoard</title>
    <!-- Bootstrap css -->
    <?php require_once 'includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="sass/login_styles.css">
    <link rel="shortcut icon" href="pictures/phphant.jpeg" type="image/x-icon">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="brand-wrapper border p-2 d-flex justify-content-start align-items-center">
                <a href="">
                    <img src="pictures/lamp-logo.png" height="56" alt="">
                </a>
                <a class="navbar-brand nav-brand-text" href="#">LAMP Libraries</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active rounded ms-5">
                        <a class="nav-link btn btn-outline-dark" href="products/product_index.php">MANAGE MEDIA</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- LOGOUT BUTTON -->
    <div class="btn-container mt-2 me-3 float-end">
        <a class="btn btn-outline-warning  p-2" href="logout.php?logout">Log out</a>
    </div>
    <!-- EDIT USER TABLE -->
    <h1 class="text-center mt-3">Welcome <?php echo $admName ?></h1>
    <div class="container edit-user-container m-auto w-75 mt-4 shadow-lg p-4">
        <div class="row">
            <div class="col-2">
                <img class="userImage" src="pictures/admavatar.png" alt="Adm avatar">
                <p class=""><?php echo $admName ?></p>
                <a href="products/product_index.php" class="btn btn-outline-dark">Manage Media</a>
            </div>
            <div class="col-8 mt-2">
                <p class='h2'>Manage Users</p>
                <table class='table table-striped userTable'>
                    <thead class='table-success'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Bootstrap js -->
    <?php require_once 'includes/bootstrap_js.inc.php' ?>
</body>

</html>