<?php
session_start();

// if (isset($_SESSION['user']) != "") {
//     header("Location: ../home.php");
//     exit;
// }

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
// import service files
require_once '../includes/db_connect.inc.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM media_items JOIN publishers ON media_items.fk_publisher_id = publishers.id WHERE media_items.id ={$id};";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $title = $data["title"];
        $isbn = $data["isbn"];
        $description = $data["description"];
        $media_type = $data["media_type"];
        $author_name = $data["author_name"];
        $publication_date = $data["publication_date"];
        $status = $data["status"];
        $picture = $data["pic"];
        $publisher = $data['publisher_name'];
        $publisher_address = $data['publisher_address'];
        $added = $data["added_to_lib_at"];
        if (strtolower($status) == 'available') {
            $class = "text-success";
        } else if (strtolower($status) == 'reserved') {
            $class = "text-danger";
        } else {
            $class = "Availability information unavailable.";
        }
    } else {
        header("location: product_error.php");
    }
    mysqli_close($connect);
} else {
    header("location: product_error.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Show Details</title>
    <!-- Bootstrap css -->
    <?php require_once '../includes/bootstrap_css.inc.php' ?>
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
                                <a class="dropdown-item" href="product_index.php/#pubList">Sort by Publisher</a>
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
    <!--  Display Card -->
    <div class="container w-75 mt-3">
        <div class="card m-auto border rounded dispCard" style="max-width: 70vw;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../pictures/<?= $picture ?>" class="img-fluid rounded-start cardImg" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $title . ' (' . $publication_date . ' ' ?>Edition)</h5>
                        <p>Author/Artist/Director:<?= ' ' . $author_name . '<br>Isbn/Catalogue: ' . $isbn . '<br>Type: ' . $media_type ?>
                        </p>

                        <p class="cardDesc"><?= $description ?></p>
                        <p class="cardPublisher"><?= $publisher . '<br>' . $publisher_address ?></p>

                        <h6 class="<?= $class ?>"><?= 'This item is currently ' . strtolower($status) ?></h6>
                        <p class="card-text">
                            <small class="text-muted">Added to library:<?= ' ' . $added ?></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- BUTTONS -->
        <div class="container w-75 showBtns">
            <div class='mt-5 mb-5 d-flex justify-content-evenly'>
                <a href="product_create.php">
                    <button class='<?php if (isset($_SESSION["adm"])) {
                                        echo "btn btn-primary action-btn p-3 shadow-lg";
                                    } else {
                                        echo "d-none";
                                    } ?>' type="button">Add Media Item</button>
                </a>
                <?php
                if (isset($_SESSION["user"])) {
                    echo " <a href='reserve.php'>
                    <button class='btn btn-primary action-btn p-3 shadow-lg' type='button'>Reserve
                Media Item</button>
                </a>";
                }
                ?>
                <a href="product_index.php">
                    <button class='btn btn-success action-btn p-3 shadow-lg' type="button">Back to All Media
                        Items</button>
                </a>
            </div>
        </div>
    </div>
    <!-- Bootstrap js -->
    <?php require_once '../includes/bootstrap_js.inc.php' ?>
</body>

</html>