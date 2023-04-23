<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, initial-scale=1.0">
    <title>Add New Tour</title>
    <link rel="shortcut icon" href="img/everest.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once 'includes/bootstrap_css.inc.php'; ?>
    <!-- Additional sass -->
    <link rel="stylesheet" href="sass/main.css">
</head>

<body>
    <div class="create-container">
        <!-- Navbar -->
        <?php require_once 'includes/nav_root.inc.php'; ?>
        <!-- Main Body -->
        <!-- Create Table -->
        <fieldset class="mb-4">
            <legend class='h2 text-light'>Add Tour Location</legend>
            <form action="actions/a_create.php" method="POST" enctype="multipart/form-data">
                <table class='table create-table'>
                    <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="location_name" placeholder="Location Name" />
                        </td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td><input class='form-control' type="number" name="price" placeholder="Price" step="any" />
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input class='form-control' type="text" name="description" placeholder="Description" />
                        </td>
                    </tr>
                    <tr>
                        <th>Latitude</th>
                        <td><input class='form-control' type="number" name="latitude"
                                placeholder="Latitude E.g 44.444444" step="any" />
                        </td>
                    </tr>
                    <tr>
                        <th>Longitude</th>
                        <td><input class='form-control' type="number" name="longitude"
                                placeholder="Longitude E.g 44.444444" step="any" />
                        </td>
                    </tr>
                    <tr>
                        <th>Picture </th>
                        <td><input class='form-control' type="file" name="picture" /></td>
                    </tr>
                    <tr>
                        <td>
                            <button class='btn btn-primary' type="submit"> Insert Tour </button>
                        </td>
                        <td>
                            <a href="index.php">
                                <button class='btn btn-success' type="button"> Home </button>
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