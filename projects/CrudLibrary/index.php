<?php
session_start();

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
    exit;
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}

require_once 'includes/db_connect.inc.php';
require_once 'includes/sanitize.inc.php';

// initialise (empty) variables
$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    // set variables
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // sanitize user input data for clarity and security
    $clean = sanitize(array($email, $pass));
    $email = $clean[0];
    $pass = $clean[1];

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing

        $sql = "SELECT id, first_name, password, status FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if ($count == 1 && $row['password'] == $password) {
            if ($row['status'] == 'adm') {
                $_SESSION['adm'] = $row['id'];
                header("Location: dashboard.php");
            } else {
                $_SESSION['user'] = $row['id'];
                header("Location: home.php");
            }
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Login & Registration System</title>
    <link rel="shortcut icon" href="pictures/lamp-logo.png" type="image/x-icon">
    <?php require_once 'includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="sass/login_styles.css">
</head>

<body>
    <div class="container sign-in-container m-auto w-50 mt-5 shadow-lg border rounded p-3">
        <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
            autocomplete="off">
            <h2 class="text-light">Log in to B.I.G Libraries</h2>
            <hr />
            <?php
            if (isset($errMSG)) {
                echo $errMSG;
            }
            ?>

            <input type="email" autocomplete="on" name="email" class="form-control" placeholder="Your Email"
                value="<?php echo $email; ?>" maxlength="40" />
            <span class="text-danger"><?php echo $emailError; ?></span>

            <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
            <span class="text-danger"><?php echo $passError; ?></span>
            <hr />
            <button class="btn btn-block btn-primary" type="submit" name="btn-login">Sign In</button>
            <hr />
            <a href="register.php">Not registered yet? Click here</a>
        </form>
    </div>
    <div class="container m-auto w-25 border bg-dark text-light mt-4 p-3 login-deets border rounded shadow-lg">
        <p>To sign in with admin privileges use:</p>
        <p>Email: andi@admin.com</p>
        <p>Password: admin123</p>
    </div>
    <!-- Bootstrap js -->
    <?php require_once 'includes/bootstrap_js.inc.php' ?>
</body>

</html>