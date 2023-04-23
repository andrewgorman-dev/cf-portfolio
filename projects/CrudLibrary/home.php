<?php
session_start();
require_once 'includes/db_connect.inc.php';

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

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$user = $row['first_name'];

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?php echo $row['first_name']; ?></title>
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
                    <li class="nav-item  border rounded ms-5">
                        <a class="nav-link" href="products/product_index.php">BROWSE MEDIA</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- LOGOUT BUTTON -->
    <div class="btn-container mt-2 me-3 float-end">
        <a class="btn btn-outline-warning  p-2" href="logout.php?logout">Log out</a>
    </div>
    <!-- Home Page Welcome Screen -->
    <div class="container home-container m-auto w-75 border rounded p-4">
        <h1 class="text-center text-light">Welcome <?php echo $user ?></h1>
        <div class="hero p-1">
            <img class="userImage img-thumbnail rounded-circle" src="pictures/<?php echo $row['picture']; ?>"
                alt="<?php echo $row['first_name']; ?>">
            <p class="text-white">Welcome <?php echo $row['first_name']; ?></p>
        </div>
        <a href="logout.php?logout">Sign Out</a>
        <a href="update.php?id=<?php echo $_SESSION['user'] ?>">Update your profile</a>
    </div>
    <!-- Bootstrap js -->
    <?php require_once 'includes/bootstrap_js.inc.php' ?>
</body>

</html>