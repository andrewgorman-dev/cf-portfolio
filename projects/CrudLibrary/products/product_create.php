<?php
session_start();

require_once '../includes/db_connect.inc.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

// Query to bring in publishers (NEW SYNTAX IN WHILE LOOP just arrow head...bUT NO F***ing backticks!!!!!!!!)
$publishers = "";
$sql = "SELECT * FROM publishers;";
$res = mysqli_query($connect, $sql);
while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
    $publishers .= "<option value={$row['id']}>{$row['publisher_name']}</option>";
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Add New Item</title>
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
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavDropdown">
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
                                <a class='nav-link active' aria-current='page' href='product_create.php'>ADD MEDIA</a>
                            </li>";
                    } ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- LOGOUT BUTTON -->
    <div class="btn-container mt-2 me-3 float-end">
        <a class="btn btn-outline-warning  p-2" href="../logout.php?logout">Log out</a>
    </div>
    <!-- CREATE FORM -->
    <div class="container w-75 m-auto">
        <form action="actions/a_create.php" method="POST" enctype="multipart/form-data">
            <h2 class="w-75 m-auto mt-3 mb-3 text-light">Add New Media Item</h2>
            <table class='table table-dark table-hover m-auto w-75 shadow-lg'>
                <!-- $title -->
                <tr>
                    <th>Title</th>
                    <td>
                        <input class='form-control' type="text" name="title" placeholder="Title" />
                    </td>
                </tr>
                <!-- $description -->
                <tr>
                    <th>Description</th>
                    <td>
                        <input class='form-control' type="text" name="description" placeholder="Brief description" />
                    </td>
                </tr>
                <!-- $media_type -->
                <tr>
                    <th>Type</th>
                    <td>
                        <input class='form-control' type="text" name="media_type" placeholder="Book CD or DVD" />
                    </td>
                </tr>
                <!-- $author_name -->
                <tr>
                    <th>Author full name</th>
                    <td>
                        <input class='form-control' type="text" name="author_name" placeholder="E.g Oscar Wilde" />
                    </td>
                </tr>
                <!-- $isbn -->
                <tr>
                    <th>Isbn</th>
                    <td>
                        <input class='form-control' type="number" name="isbn" placeholder="E.g 97746231879543"
                            step="any" />
                    </td>
                </tr>
                <!-- $publication_date -->
                <tr>
                    <th>Date Published</th>
                    <td>
                        <input class='form-control' type="date" name="publication_date" placeholder="E.g 1990"
                            step="any" />
                    </td>
                </tr>
                <!-- $status -->
                <tr>
                    <th>Status</th>
                    <td>
                        <input class='form-control' type="text" name="status" placeholder="E.g Available or Reserved" />
                    </td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        <input class='form-control' type="file" name="picture" />
                    </td>
                </tr>
                <!-- NEW DROPDOWN publisher (Supplier) -->
                <tr>
                    <th>Publisher/Producer</th>
                    <td>
                        <select class="form-select" name="publisher" aria-label="Default select example">
                            <?php echo $publishers; ?>
                            <option selected value="none">Undefined</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class='btn btn-primary action-btn' type="submit">Insert Item</button>
                    </td>
                    <td>
                        <a href="product_index.php">
                            <button class='btn border btn-success text-light action-btn' type="button">Back to
                                Media</button>
                        </a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!-- Javascript -->
    <!-- Bootstrap js -->
    <?php require_once '../includes/bootstrap_js.inc.php' ?>
</body>

</html>