<?php
session_start(); // start a new session or continues the previous
if (isset($_SESSION['user']) != "") {
    header("Location: home.php"); // redirects users to home.php
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects admin to home.php
}

// import service files
require_once 'includes/db_connect.inc.php';
require_once 'includes/file_upload.inc.php';
require_once 'includes/sanitize.inc.php';

// initialise empty variables
$error = false;
$fname = $lname = $email = $date_of_birth = $pass = $picture = '';
$fnameError = $lnameError = $emailError = $dateError = $passError = $picError = '';
if (isset($_POST['btn-signup'])) {

    // set variables
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    if ($pass1 === $pass2) {
        $pass = $pass1;
    } else {
        $pass = $pass1;
        $error = true;
        $passError = "Passwords do not match.";
    }

    // sanitize user input data for clarity and security
    $clean = sanitize(array($fname, $lname, $email, $date_of_birth, $pass));
    $fname = $clean[0];
    $lname = $clean[1];
    $email = $clean[2];
    $date_of_birth = $clean[3];
    $pass = $clean[4];

    // Image file processing
    $uploadError = '';
    $picture = file_upload($_FILES['picture']);

    // basic name validation
    if (empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your full name and surname";
    } else if (strlen($fname) < 3 || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces.";
    }

    //basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
        // checks whether the email exists or not
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    //checks if the date input was left empty
    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "Please enter your date of birth.";
    }
    // password validation
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    // password hashing for security
    $password = hash('sha256', $pass);
    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO users(first_name, last_name, password, date_of_birth, email, picture)
                 VALUES('$fname', '$lname', '$password', '$date_of_birth', '$email', '$picture->fileName')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may now login.";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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
    <?php require_once 'includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="sass/login_styles.css">
    <link rel="shortcut icon" href="pictures/phphant.jpeg" type="image/x-icon">
</head>

<body>
    <div class="container sign-up-container m-auto mt-5 w-50 p-4 border rounded">
        <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
            autocomplete="off" enctype="multipart/form-data">
            <h2 class="text-light">Sign Up to B.I.G Libraries</h2>
            <hr />
            <?php
            if (isset($errMSG)) {
            ?>
            <div class="alert alert-<?php echo $errTyp ?>">
                <p><?php echo $errMSG; ?></p>
                <p><?php echo $uploadError; ?></p>
            </div>

            <?php
            }
            ?>
            <label for="fname">First name</label>
            <input type="text" name="fname" class="form-control" placeholder="First name" maxlength="50"
                value="<?php echo $fname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>
            <label for="lname">Last name</label>
            <input type="text" name="lname" class="form-control" placeholder="Surname" maxlength="50"
                value="<?php echo $lname ?>" />
            <span class="text-danger"> <?php echo $lnameError; ?> </span>
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email" maxlength="40"
                value="<?php echo $email ?>" />
            <span class="text-danger"> <?php echo $emailError; ?> </span>
            <label for="date_of_birth">Date of Birth</label>
            <input class='form-control' type="date" name="date_of_birth" value="<?php echo $date_of_birth ?>" />
            <span class="text-danger"> <?php echo $dateError; ?> </span>
            <label for="picture">Upload your image (optional)</label>
            <input class='form-control' type="file" name="picture">
            <span class="text-danger"> <?php echo $picError; ?> </span>
            <label for="pass">Create Password (minimum 6 characters)</label>
            <input type="password" name="pass1" class="form-control" placeholder="Enter Password" maxlength="15" />
            <input type="password" name="pass2" class="form-control mt-1" placeholder="Re-enter Password"
                maxlength="15" />
            <span class="text-danger"> <?php echo $passError; ?> </span>
            <hr />
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            <hr />
            <a href="index.php">Sign in Here...</a>
        </form>
    </div>
    <!-- Bootstrap js -->
    <?php require_once 'includes/bootstrap_js.inc.php' ?>
</body>

</html>