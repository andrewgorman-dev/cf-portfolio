<?php
session_start();
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

//import service files
require_once '../includes/db_connect.inc.php';

// Query all records from db table
$sql = "SELECT * FROM media_items";
$result = mysqli_query($connect, $sql);
$tbody = "";

// SORT by Publisher query
// $sql2 = "SELECT * FROM media_items JOIN publishers ON media_items.fk_publisher_id = publishers.id GROUP BY publishers.publisher_name;";
$sql2 = "SELECT publishers.publisher_name FROM media_items JOIN publishers ON media_items.fk_publisher_id = publishers.id GROUP BY publishers.publisher_name;";
$result2 = mysqli_query($connect, $sql2);
$pubList = "";

// Get username
$userName = "";
if (isset($_SESSION['user'])) {
    $sql3 = "SELECT first_name, last_name FROM users WHERE id = {$_SESSION['user']};";
    $result3 = mysqli_query($connect, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $userName = $row3['first_name'] . ' ' . $row3['last_name'];
}
// Or get admin name
if (isset($_SESSION['adm'])) {
    $sql3 = "SELECT first_name, last_name FROM users WHERE id = {$_SESSION['adm']};";
    $result3 = mysqli_query($connect, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $userName = $row3['first_name'] . ' ' . $row3['last_name'];
}


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "<tr class='border table-rows'>
                    <td scope='row'>
                        <img src='../pictures/" . $row['pic'] . "' class='img-thumbnail'>
                    </td>
                    <td>" . $row['title'] . "</td>
                    <td class='descRow'>" . $row['description'] . "</td>
                    <td>" . $row['media_type'] . "</td>
                    <td>" . $row['isbn'] . "</td>
                    <td>" . $row['author_name'] . "</td>
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

// Second query to stop repeating publisher names
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        $pubList .= "<ul class='m-auto'>
                        <li class='p-3'>
                            <a href='sort.php?publisher_name=" . $row['publisher_name'] . "' class='text-light'>$row[publisher_name]</a>
                        </li>
                    </ul>";
    };
}

// var_dump($result);
// var_dump($result2);
// Close connection
mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>All Media<?php echo " " . $userName ?></title>
    <!-- Bootstrap css cdn -->
    <?php require_once '../includes/bootstrap_css.inc.php' ?>
    <!-- Sass -->
    <link rel="stylesheet" href="../sass/prod_styles.css">
    <link rel="shortcut icon" href="../pictures/phphant.jpeg" type="image/x-icon">
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
                                <a class='nav-link' aria-current='page' href='product_create.php'>ADD MEDIA</a>
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
    <!-- Main Table -->
    <div class="container m-auto mt-3 mb-3 tableContainer">
        <p class='h2 media-title text-light'>All Current Media</p>

        <table class='table table-striped table-dark table-hover border fixed-table-body'>
            <thead>
                <tr class="colTitles">
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Type</th>
                    <th scope="col">ISBN/Catalogue No</th>
                    <th scope="col">Author Name</th>
                    <th scope="col">Publication Date</th>
                    <!-- <th scope="col">Publisher Name</th> -->
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Display DB Data -->
                <?= $tbody; ?>
            </tbody>
        </table>

        <!-- Create BUTTON FOR admin only-->
        <?php if (isset($_SESSION["adm"])) {
            echo "<div class='mt-5 mb-5 text-center'>
                    <a href='product_create.php'>
                        <button class='btn btn-primary action-btn p-3 shadow-lg' type='button'>Add Media Item</button>
                    </a>
                 </div>";
        } ?>
    </div>

    <!-- LIST OF PUBLISHERS -->
    <div class="container w-75 mt-4 mb-5 border bg-dark text-light p-4 pubListContainer">
        <h3 class="text-center">List of Publishers</h3>
        <hr>
        <div class="pubList" id="pubList">
            <?= $pubList ?>
        </div>
    </div>

    <footer>
        <a href="">
            <img src="../pictures/lamp-logo.png" height="56" alt="">
        </a>
        <a class="navbar-brand nav-brand-text" href="#">LAMP Libraries &#169;2021</a>
    </footer>
    <!-- Bootstrap js cdn -->
    <?php require_once '../includes/bootstrap_js.inc.php' ?>
</body>

</html>