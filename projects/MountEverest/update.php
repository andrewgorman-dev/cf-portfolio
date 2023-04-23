<?php
// Connect to DB
require_once 'includes/db_connect.inc.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM locations WHERE loc_id = {$id};";
    $res = mysqli_query($connect, $sql);
    if (mysqli_num_rows($res) == 1) {
        $data = mysqli_fetch_assoc($res);
        $loc = $data['location_name'];
        $price = $data['price'];
        $desc = $data['description'];
        $lat = $data['latitude'];
        $lng = $data['longitude'];
        $pic = $data['picture'];
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
    <title>Edit Tour Info</title>
    <link rel="shortcut icon" href="img/everest.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once 'includes/bootstrap_css.inc.php'; ?>
    <!-- Additional sass -->
    <link rel="stylesheet" href="sass/main.css">
</head>

<body>
    <div class="update-container">
        <!-- Navbar -->
        <?php require_once 'includes/nav_root.inc.php'; ?>
        <fieldset class="fieldset-update">
            <legend class='h2 me-3'>Update Location Details
                <img class='img-thumbnail rounded-circle' src='img/<?php echo $pic ?>' alt="<?php echo $loc ?>">
            </legend>
            <form action="actions/a_update.php" method="POST" enctype="multipart/form-data">
                <table class="table table-hover">
                    <tr>
                        <th>Location Name</th>
                        <td>
                            <input class="form-control" type="text" name="location_name" placeholder="Location Name"
                                value="<?php echo $loc ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>
                            <input class="form-control" type="number" name="price" step="any" placeholder="Price"
                                value="<?php echo $price ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>
                            <input class="form-control" type="text" name="description" placeholder="Description"
                                value="<?php echo $desc ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>Latitude</th>
                        <td>
                            <input class="form-control" type="number" name="latitude" step="any" placeholder="Latitude"
                                value="<?php echo $lat ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>Longitude</th>
                        <td><input class="form-control" type="number" name="longitude" step="any"
                                placeholder="Longitude" value="<?php echo $lng ?>" /></td>
                    </tr>
                    <tr>
                        <th>Picture</th>
                        <td>
                            <input class="form-control" type="file" name="picture" />
                        </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id" value="<?php echo $id ?>" />
                        <input type="hidden" name="picture" value="<?php echo $pic ?>" />
                        <td>
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </td>
                        <td>
                            <a href="index.php">
                                <button class="btn btn-success" type="button">Home</button>
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
        <!-- Footer -->
        <?php require_once 'includes/footer.php'; ?>
    </div>
    <!-- Bootstrap js cdn -->
    <?php require_once 'includes/bootstrap_js.inc.php'; ?>
</body>

</html>