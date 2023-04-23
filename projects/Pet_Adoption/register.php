<?php
session_start(); // start a new session or continues the previous
if (isset($_SESSION['user']) != "") {
    header("Location: home.php"); // redirects to home.php
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}
require_once 'includes/db_connect.inc.php';
require_once 'includes/file_upload.inc.php';
$error = false;
$fname = $lname = $email = $date_of_birth = $user_address = $phone_number = $pass = $picture = '';
$fnameError = $lnameError = $emailError = $dateError = $addressError = $phoneError = $passError = $picError = '';
if (isset($_POST['btn-signup'])) {

    // sanitize user input to prevent sql injection
    $fname = trim($_POST['fname']);

    //trim - strips whitespace (or other characters) from the beginning and end of a string
    $fname = strip_tags($fname);

    // strip_tags -- strips HTML and PHP tags from a string

    $fname = htmlspecialchars($fname);
    // htmlspecialchars converts special characters to HTML entities

    $lname = trim($_POST['lname']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $date_of_birth = trim($_POST['date_of_birth']);
    $date_of_birth = strip_tags($date_of_birth);
    $date_of_birth = htmlspecialchars($date_of_birth);

    $user_address = $_POST['user_address'];

    $phone_number = $_POST['phone_number'];

    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    if ($pass1 === $pass2) {
        $pass = $pass1;
    } else {
        $pass = $pass1;
        $error = true;
        $passError = "Passwords do not match.";
    }
    $pass = trim($pass);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

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
        $query = "SELECT email FROM user WHERE email='$email'";
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

        $query = "INSERT INTO user(first_name, last_name, password, date_of_birth, user_address, phone_number, email, picture)
                  VALUES('$fname', '$lname', '$password', '$date_of_birth', '$user_address', '$phone_number', '$email', '$picture->fileName')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration System</title>
    <?php require_once 'includes/bootstrap_css.inc.php' ?>
    <link rel="stylesheet" href="sass/main.css">
</head>

<body>
    <div class="container register-container shadow-lg rounded">
        <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
            autocomplete="off" enctype="multipart/form-data">
            <h2>Create an account with Adopt-a-Pet</h2>
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

            <input type="text" name="fname" class="form-control mb-1" placeholder="First name" maxlength="50"
                value="<?php echo $fname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>

            <input type="text" name="lname" class="form-control mb-1" placeholder="Surname" maxlength="50"
                value="<?php echo $lname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>
            <!-- address -->
            <input type="text" name="user_address" class="form-control mb-1" placeholder="address"
                value="<?php echo $user_address ?>" />

            <!-- phone_number -->
            <input type="text" name="phone_number" class="form-control mb-1" placeholder="tel" maxlength="50"
                value="<?php echo $phone_number ?>" />

            <input type="email" name="email" class="form-control mb-1" placeholder="Enter Your Email" maxlength="40"
                value="<?php echo $email ?>" />
            <span class="text-danger"> <?php echo $emailError; ?> </span>
            <label for="date_of_birth">Your date of birth</label>
            <input class='form-control mb-1' type="date" name="date_of_birth" value="<?php echo $date_of_birth ?>" />
            <span class="text-danger"> <?php echo $dateError; ?> </span>
            <label for="picture">Upload image (if desired)</label>
            <input class='form-control mb-1' type="file" name="picture">
            <span class="text-danger"> <?php echo $picError; ?> </span>
            <input type="password" name="pass1" class="form-control mb-1" placeholder="Enter Password" maxlength="15" />
            <input type="password" name="pass2" class="form-control" placeholder="Re-enter Password" maxlength="15" />
            <span class="text-danger"> <?php echo $passError; ?> </span>
            <hr />
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            <hr />
            <a href="index.php">Sign in Here...</a>
        </form>
    </div>
</body>

</html>