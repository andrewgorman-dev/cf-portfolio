<?php
require_once '../includes/db_connect.inc.php';
session_start();
// declare variables
$tbody = "";
$publisher_address = "";


if ($_GET['publisher_name']) {
    $publisher_name = $_GET['publisher_name'];
    $sql = "SELECT media_items.*, publishers.id as pId, publishers.publisher_name, publishers.publisher_address FROM media_items JOIN publishers ON media_items.fk_publisher_id = publishers.id WHERE publisher_name = '$publisher_name';";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $publisher_address = $row['publisher_address'];
            $tbody .= "<tr class='border table-rows'>
                        <td scope='row'>
                            <img src='../pictures/" . $row['pic'] . "' class='img-thumbnail'>
                        </td>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['description'] . "</td>
                        <td>" . $row['media_type'] . "</td>
                        <td>" . $row['author_name'] . "</td>
                        <td>" . $row['isbn'] . "</td>
                        <td>" . $row['publication_date'] . "</td>
                        <td>
                            <a href='show.php?id=" . $row['id'] . "'>
                                <button class='m-1 btn btn-outline-info btn-sm action-btn' type='button'>Show Media</button>
                            </a>";
            if (isset($_SESSION["adm"])) {
                $tbody .= "<a href='product_update.php?id=" . $row['id'] . "'>
                                <button class='m-1 btn btn-outline-primary btn-sm action-btn' type='button'>Update</button>
                            </a>
                            <br/>
                            <a href='product_delete.php?id=" . $row['id'] . "'>
                                <button class='m-1 btn btn-outline-danger btn-sm action-btn' type='button'>Delete</button>
                            </a>";
            }
            if (isset($_SESSION["user"])) {
                $tbody .= "<a href='reserve.php?id=" . $row['id'] . "'>
                                <button class='m-1 btn btn-outline-success btn-sm action-btn' type='button'>Reserve</button>
                            </a>";
            }
            echo "</td>
                    </tr>";
        };
    } else {
        $tbody = "<tr class='border'>
                    <td colspan='7'>
                        <center class='noDataMsg'>No Data Available</center>
                    </td>
                </tr>";
    }
} else {
    header("location: error.php");
}

// Close connection
mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Sort by Publisher</title>
    <!-- Bootstrap css cdn -->
    <?php require_once '../includes/bootstrap_css.inc.php' ?>
    <!-- Sass -->
    <link rel="stylesheet" href="../sass/prod_styles.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <div class="brand-wrapper border p-2 d-flex justify-content-start align-items-center">
                <a href="">
                    <img src="../pictures/lamp-logo.png" height="56" alt="">
                </a>
                <a class="navbar-brand nav-brand-text" href='<?php if (isset($_SESSION['adm'])) {
                                                                    echo "../dashboard.php";
                                                                } else {
                                                                    echo "../home.php";
                                                                } ?>'>LAMP Libraries</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav w-50 d-flex justify-content-evenly align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href='<?php if (isset($_SESSION['adm'])) {
                                                                            echo "../dashboard.php";
                                                                        } else {
                                                                            echo "../home.php";
                                                                        } ?>'>ACCOUNT HOME</a>
                    </li>
                    <!-- ADD LINK FOR ADMIN ONLY -->
                    <?php if (isset($_SESSION['adm'])) {
                        echo "<li class='nav-item'>
                                <a class='nav-link' aria-current='page' href='product_create.php'>ADD</a>
                            </li>";
                    } ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            SORT
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#pubList">Sort by Publisher</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="product_type.php">Sort by Type</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- LOGOUT BUTTON -->
    <div class="btn-container mt-2 me-3 float-end">
        <a class="btn btn-outline-warning  p-2" href="../logout.php?logout">Log out</a>
    </div>
    <!-- Publisher Table -->
    <div class="tableContainer mt-3">
        <p class='h2 media-title'>All Media from <?= $publisher_name ?></p>
        <table class="table table-striped table-dark table-hover border fixed-table-body">
            <thead>
                <tr class="colTitles">
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Type</th>
                    <th scope="col">Author Name</th>
                    <th scope="col">ISBN/Catalogue No</th>
                    <th scope="col">Publication Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?= $tbody ?>
            </tbody>
        </table>
        <!-- BUTTONS HIDE ADD FOR USER-->
        <div class='mt-5 mb-5 d-flex justify-content-between'>
            <a href="product_create.php">
                <button class="<?php if (isset($_SESSION['adm'])) {
                                    echo  "btn btn-primary action-btn p-3 shadow-lg";
                                } else {
                                    echo "d-none";
                                } ?>
                                " type="button">Add Media Item</button>
            </a>
            <a href="product_index.php">
                <button class='btn btn-success action-btn p-3 shadow-lg' type="button">Back to All Media
                    Items</button>
            </a>
        </div>
        <!-- CONTACT DETAILS -->
        <div class="contactPub w-25 text-light shadow p-3">
            <p>Contact <?= $publisher_name ?>:</p>
            <p>Address: <?= $publisher_address ?> </p>
        </div>
    </div>
    <!-- Bootstrap js cdn -->
    <?php require_once '../includes/bootstrap_js.inc.php' ?>
</body>

</html>