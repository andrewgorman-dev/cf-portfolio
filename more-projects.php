<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="main-img/main-icons/lamp-logo.png" type="image/x-icon">
    <title>More Projects</title>
    <!-- Bootstrap css local -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <!-- Bootstrap css cdn -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <!-- Additional Sass -->
    <link rel="stylesheet" href="sass/main.css">
</head>
<style>
.about-link {
    box-shadow: 2px 2px 4px rgba(217, 202, 211, 0.8), -2px -2px 3px rgba(180, 190, 200, 0.7);
}
</style>

<body style="background-image: url('main-img/modern1.jpg'); background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;">
    <!-- Navbar -->
    <?php require_once 'components/nav.php'; ?>
    <!-- Main Content -->
    <div class="more-proj-container container m-auto p-5">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card m-auto p-2 proj-card" style="width: 18rem;">
                    <img src="main-img/main-icons/phpsql.jpeg" class="card-img-top"
                        style="height: 14rem; width: 100%; object-fit: cover;" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Adopt-a-Pet</h5>
                        <p class="card-text desc">Full stack application with login system providing a user and admin
                            experience based around the concept of pet adoption.</p>
                        <hr>
                        <p class="card-text card-tech">Technologies: PHP, MySQL, HTML, SASS</p>
                        <hr>
                        <a href="projects/Pet_Adoption/" target="_blank"
                            class="btn btn-outline-info p-3 btn-lg border rounded">
                            View Project
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card m-auto p-2 proj-card" style="width: 18rem;">
                    <img src="main-img/main-icons/es6.jpeg" class="card-img-top"
                        style="height: 14rem; width: 100%; object-fit: cover;" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Old Skool Films</h5>
                        <p class="card-text desc">Front end application using modern Javascript to display films in
                            orders
                            <hr>
                        <p class="card-text card-tech">Technologies: JS (ES6+) HTML SASS</p>
                        <hr>
                        <a href="projects/MovieFan/" target="_blank"
                            class="btn btn-outline-info p-3 btn-lg border rounded">
                            View Project
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Navbar -->
    <?php require_once 'components/footer.php'; ?>
</body>

</html>