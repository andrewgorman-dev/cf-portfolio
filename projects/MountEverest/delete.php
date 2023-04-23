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
    <div class="delete-container">
        <fieldset>
            <legend class='h2 mb-3 text-light'> Delete request <img class='img-thumbnail rounded-circle'
                    src='img/<?php echo $pic ?>' alt="<?php echo ucwords($loc) ?>">
            </legend>
            <h5 class="text-light">You have selected the data below:</h5>
            <table class="table w-75 mt-3">
                <tr>
                    <td class="text-light"><?php echo  ucwords($loc) . " " . $desc ?></td>
                </tr>
            </table>
            <h3 class="mb-4 text-light">Do you really want to delete this product? </h3>
            <form action="actions/a_delete.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <input type="hidden" name="picture" value="<?php echo $pic ?>" />
                <button class="btn btn-danger" type="submit"> Yes, delete it! </button>
                <a href="index.php">
                    <button class="btn btn-warning" type="button"> No, go back! </button>
                </a>
            </form>
        </fieldset>
    </div>
    <!-- Bootstrap js cdn -->
    <?php require_once 'includes/bootstrap_js.inc.php'; ?>
</body>

</html>