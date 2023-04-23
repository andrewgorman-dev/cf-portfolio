<?php

// Connect to DB
require_once 'includes/db_connect.inc.php';

// Query to show all locations
$sql = "SELECT * FROM locations;";
$res = mysqli_query($connect, $sql);
$col = "";
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $col
            .= "<div class='col-lg-4 col-md-6 col-sm-12 gy-4'>
                    <a href='show_details.php?id=" . $row['loc_id'] . "' class='outer-card-anchor'>
                        <div class='hp-card m-auto shadow rounded' style='width: 18rem;'>
                            <img src='img/" . $row['picture'] . "' class='card-img-top' style='width: 18rem; height: 14rem; object-fit: cover;' alt='...'>
                            <div class='card-body bg-light'>
                              <h5 class='card-title'>" . ucwords($row['location_name']) . "</h5>
                                <p class='card-text' style='width: 16rem; height: 5rem;' >" . $row['description'] . "</p>
                                <hr/>
                                <p class='card-text'>Our Tour Price: $" . $row['price'] . "</p>
                                <hr/>
                                <div class='btn-container m-auto text-center'>
                                    <a href='update.php?id=" . $row['loc_id'] . "' class='btn btn-outline-primary card-btn'>Update</a>
                                    <a href='delete.php?id=" . $row['loc_id'] . "' class='btn btn-outline-danger card-btn'>Delete</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>";
    }
} else {
    $col = "<h2>We currently have no tours on offer due to Covid-19 restrictions.</h2>";
}

mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>CR12 Mount Everest</title>
    <link rel="shortcut icon" href="img/everest.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once 'includes/bootstrap_css.inc.php'; ?>
    <!-- Additional sass -->
    <link rel="stylesheet" href="sass/main.css">
</head>

<body>
    <!-- HP Container -->
    <div class="index-container">
        <!-- Navbar -->
        <?php require_once 'includes/nav_root.inc.php'; ?>
        <!-- Main Content -->
        <main>
            <div class="container mx-auto p-4 mt-3 mb-3 loc_container">
                <h1 class="text-center text-light hp-title">All Tours</h1>
                <div class="row">
                    <!-- Populate with all locations from DB -->
                    <?php echo $col; ?>
                </div>
                <!-- Create Button -->
                <div class="createBtn mt-5 ps-2">
                    <a href="create.php" class="btn btn-lg btn-outline-light">Add New Tour</a>
                </div>
            </div>
        </main>
        <!-- Footer -->
        <?php require_once 'includes/footer.php'; ?>
    </div>
    <!-- Bootstrap js cdn -->
    <?php require_once 'includes/bootstrap_js.inc.php'; ?>
</body>

</html>