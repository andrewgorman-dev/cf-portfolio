<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <?php require_once '../includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="../sass/prod_styles.css">
    <title>ERROR(Product)</title>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1 class="text-light">Invalid request</h1>
        </div>
        <div class="alert alert-warning" role="alert">
            <p>You've made an invalid request. Please
                <a href="product_index.php" class="alert-link">go back</a>
                to index and
                try again.
            </p>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <?php require_once '../includes/bootstrap_js.inc.php' ?>
</body>

</html>