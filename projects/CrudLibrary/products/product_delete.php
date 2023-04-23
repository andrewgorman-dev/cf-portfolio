<?php
// check the session redirect as necessary
session_start();

// if (isset($_SESSION['user']) != "") {
//     header("Location: ../home.php");
//     exit;
// }
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../product_index.php");
    exit;
}

//import services
require_once '../includes/db_connect.inc.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM media_items WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $title = $data["title"];
        $isbn = $data["isbn"];
        $description = $data["description"];
        $media_type = $data["media_type"];
        $author_name = $data["author_name"];
        $publication_date = $data["publication_date"];
        $status = $data["status"];
        $picture = $data["pic"];
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Delete Media Item</title>
    <?php require_once '../includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="../sass/prod_styles.css">
</head>

<body>
    <div class="container delete-container border rounded p-4 mt-5 text-light m-auto w-50">
        <fieldset>
            <legend class='h2 mb-3 m-auto'>Delete request
                <img class='img-thumbnail ms-1' src='../pictures/<?php echo $picture ?>' alt="<?php echo $title ?>">
            </legend>
            <!-- Table -->
            <h5>You have selected the data below:</h5>
            <table class="table w-75 mt-3">
                <tr>
                    <td>
                        <h2 class="text-light"><?php echo $title ?></h2>
                        <p class="text-light">
                            <?php echo $author_name . ' ' . $media_type . ' (' . $publication_date . ' edition)' ?>
                        </p>
                    </td>
                </tr>
            </table>
            <!-- Form -->
            <h3 class="mb-4">Do you really want to delete this product?</h3>
            <form action="actions/a_delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                <button class="btn btn-danger" type="submit">Yes, delete it!</button>
                <a href="product_index.php">
                    <button class="btn btn-warning" type="button">No, go back!</button>
                </a>
            </form>
        </fieldset>
    </div>
    <!-- Bootstrap js -->
    <?php require_once '../includes/bootstrap_js.inc.php' ?>
</body>

</html>