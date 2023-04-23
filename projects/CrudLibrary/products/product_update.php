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
    $sql = "SELECT * FROM media_items WHERE id ={$id};";
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
        $publisher = $data['fk_publisher_id'];

        $sql1 = "SELECT * FROM publishers;";
        $resultPub = mysqli_query($connect, $sql1);
        $pubList = "";
        if (mysqli_num_rows($resultPub) > 0) {
            while ($row = $resultPub->fetch_array(MYSQLI_ASSOC)) {
                if ($row['id'] == $publisher) {
                    $pubList .= "<option selected value='{$row['id']}'>{$row['publisher_name']}</option>";
                } else {
                    $pubList .= "<option value='{$row['id']}'>{$row['publisher_name']}</option>";
                }
            }
        } else {
            $pubList = "<li>There are no publishers registered</li>";
        }
    } else {
        header("location: product_error.php");
    }
    $connect->close();
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
    <title>Edit Item</title>
    <!-- Bootstrap css -->
    <?php require_once '../includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="../sass/prod_styles.css">
</head>

<body>
    <div class="container prod-update-container m-auto mt-4 mb-4 text-left">
        <div class="w-50 m-auto text-light d-flex justify-content-start align-items-center">
            <p class="me-4 title w-50">Update request</p>
            <img src="../pictures/<?php echo $picture; ?>" alt="<?php echo $title; ?>"
                class="w-50img-thumbnail rounded mb-3">
        </div>
        <form action="actions/a_update.php" method="POST" enctype="multipart/form-data">
            <table class='table table-dark table-hover w-50 m-auto shadow'>
                <tr>
                    <th>Title</th>
                    <td>
                        <input class='form-control' type="text" name="title" placeholder="Title"
                            value=<?php echo $title; ?> />
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>
                        <input class='form-control' type="text" name="description" placeholder="Brief description"
                            value=<?php echo $description; ?> />
                    </td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>
                        <input class='form-control' type="text" name="media_type" placeholder="Book CD or DVD"
                            value=<?php echo $media_type; ?> />
                    </td>
                </tr>
                <tr>
                    <th>Author name</th>
                    <td>
                        <input class='form-control' type="text" name="author_name" placeholder="E.g Oscar Wilde"
                            value=<?php echo $author_name; ?> />
                    </td>
                </tr>
                <tr>
                    <th>Isbn</th>
                    <td>
                        <input class='form-control' type="number" name="isbn" placeholder="E.g 1234567891234" step="any"
                            value=<?php echo $isbn; ?> />
                    </td>
                </tr>
                <tr>
                    <th>Publication date</th>
                    <td>
                        <input class='form-control' type="date" name="publication_date" placeholder="E.g 12.06.1990"
                            step="any" value=<?php echo $publication_date; ?> />
                    </td>
                </tr>
                <th>Status</th>
                <td>
                    <input class='form-control' type="text" name="status" placeholder="E.g Available or Reserved"
                        value=<?php echo $status; ?> />
                </td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        <input class='form-control' type="file" name="picture" />
                    </td>
                </tr>
                <tr>
                    <th>Publisher/Producer</th>
                    <td>
                        <select class="form-select" name="publisher" aria-label="Default select example">
                            <?php echo $pubList; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    <input type="hidden" name="picture" value="<?php echo $data['pic']; ?>">
                    <td>
                        <button class="btn btn-outline-success" type="submit">Save Changes</button>
                    </td>
                    <td>
                        <a href="product_index.php">
                            <button class="btn btn-outline-warning" type="button">Back</button>
                        </a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!-- Bootstrap js -->
    <?php require_once '../includes/bootstrap_js.inc.php' ?>
</body>

</html>