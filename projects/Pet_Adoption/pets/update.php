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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Edit Item</title>
    <!-- Bootstrap css -->
    <?php require_once '../includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="../sass/main.css">
    <style>
    th {
        vertical-align: middle;
    }
    </style>
</head>


<body>
    <div class="update-container">
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
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container prod-update-container m-auto text-center mt-4 mb-4 p-4">
            <div class="w-75 d-flex justify-content-between align-items-center flex-column">
                <img src="../pictures/<?php echo $pic; ?>" class="w-25 img-thumbnail rounded"
                    alt="<?php echo $name; ?>" />
                <h3 class="media-title w-75">Update <?php echo ' ' . $name . "'s details"; ?></h3>
            </div>
            <form action="actions/a_update.php" method="POST" enctype="multipart/form-data">
                <table class='table table-dark w-75 table-hover m-auto border-light rounded'>
                    <tr>
                        <th>Pet Name</th>
                        <td>
                            <input class='form-control' type="text" name="name" placeholder=""
                                value=<?php echo $name; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th>Species</th>
                        <td>
                            <input class='form-control' type="text" name="species" placeholder=""
                                value=<?php echo $species; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td>
                            <input class='form-control' type="number" name="age" placeholder=""
                                value=<?php echo $age; ?> step="any" />
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>
                            <input class='form-control' type="text" name="description" placeholder=""
                                value=<?php echo $desc; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td>
                            <input class='form-control' type="text" name="hobbies" placeholder="" step="any"
                                value=<?php echo $hob; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td>
                            <input class='form-control' type="text" name="size" placeholder=""
                                value=<?php echo $size; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th>Breed/Genus</th>
                        <td>
                            <input class='form-control' type="text" name="breed" placeholder=""
                                value=<?php echo $breed; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>
                            <input class='form-control' type="text" name="location" placeholder=""
                                value=<?php echo $loc; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <input class='form-control' type="text" name="status"
                                placeholder="E.g Available or Reserved" value=<?php echo $status; ?> />
                        </td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            <input class='form-control' type="file" name="picture" />
                        </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id" value="<?php echo $data['pet_id']; ?>">
                        <input type="hidden" name="picture" value="<?php echo $data['picture']; ?>">
                        <td>
                            <button class="btn btn-outline-success" type="submit">Save Changes</button>
                        </td>
                        <td>
                            <a href="../dashboard.php">
                                <button class="btn btn-outline-warning" type="button">Back</button>
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- Bootstrap js -->
        <?php require_once '../includes/bootstrap_js.inc.php' ?>
    </div>
</body>

</html>