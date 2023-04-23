<?php
$errMsg = "";
$class = "";
if ($_SERVER["REQUEST_METHOD"] == 'POST') { // Check if the User coming from a request
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // simple validation if you insert an email
    $msg = filter_var($_POST["msg"], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    // mail function in php look like this  (mail(To, subject, Message, Headers, Parameters))
    $headers = "FROM : " . $email . "\r\n";
    $myEmail = "andrewgorman.dev@gmail.com";
    if (mail($myEmail, "Email through portfolio site from " . $email, $msg, $headers)) {
        $class = "success";
        $errMsg = "Thanks for contacting me! I will be in touch soon.";
    } else {
        $class = "danger";
        $errMsg = "There was an error sending your message. Please check and try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="main-img/main-icons/lamp-logo.png" type="image/x-icon">
    <title>Contact Me</title>
    <!-- Bootstrap css local -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <!-- Bootstrap css cdn -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <!-- Additional Sass -->
    <link rel="stylesheet" href="sass/main.css">
</head>
<style>
.contact-link {
    box-shadow: 2px 2px 4px rgba(217, 202, 211, 0.8), -2px -2px 3px rgba(180, 190, 200, 0.7);
}
</style>

<body>
    <div class="contact-container">
        <!-- Navbar -->
        <?php require_once 'components/nav.php'; ?>
        <!-- Contact Form -->
        <div class="container form-container w-75">
            <h2 class="text-left text-light">Contact me directly:</h2>
            <div class="errMsg m-auto alert alert-<?= $class; ?> p-2 rounded" role="alert">
                <?php echo $errMsg ?>
            </div>
            <form method="POST" class="m-auto shadow p-4 rounded">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Your Email address</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Your Message (Or Document
                        Request)</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="msg"
                        placeholder="Request for <document name> from..."></textarea>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Send</button>
                </div>
            </form>
            <div class="m-auto mt-5 phone-box border rounded p-2 text-light shadow">
                <p>Alternatively call me on +43 660 260 3157</p>
                <p>or email me at andrewgorman.dev@gmail.com</p>
            </div>
        </div>
        <!-- Footer -->
        <?php require_once 'components/footer.php'; ?>
        <!-- Bootstrap js local-->
        <script src="bootstrap/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap js cdn -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script> -->
    </div>
</body>

</html>