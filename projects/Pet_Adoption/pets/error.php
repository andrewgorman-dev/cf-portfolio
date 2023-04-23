<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="../pictures/pet-logo.jpeg" type="image/x-icon">
    <title>Error</title>
    <!-- Bootstrap cdn -->
    <?php require_once '../includes/bootstrap_css.inc.php' ?>
    <!-- Additional Styles -->
    <link rel="stylesheet" href="../sass/main.css">
</head>

<body>
    <div class="container error-container">
        <div class="mt-3 mb-3">
            <h1>Invalid Request</h1>
        </div>
        <div class="alert alert-warning" role="alert">
            <p>You've made an invalid request. Please <a href="index.php" class="alert-link">go back</a> to index and
                try again.</p>
        </div>
    </div>
</body>

</html>