<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, initial-scale=1.0">
    <title>Add New Tour</title>
    <link rel="shortcut icon" href="img/everest.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once 'includes/bootstrap_css.inc.php'; ?>
    <!-- Additional sass -->
    <link rel="stylesheet" href="sass/main.css">
</head>

<body>
    <div class="container-fluid error-container">
        <div class="text-danger p-2">
            <h1>Invalid Request</h1>
        </div>
        <div class="alert alert-warning w-25" role="alert">
            <p class="text-danger"> You've made an invalid request.
                <br /> Please
                <a href="index.php" class="alert-link btn btn-outline-success">go back</a>
                to try again.
            </p>
        </div>
    </div>
</body>

</html>