<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="main-img/main-icons/lamp-logo.png" type="image/x-icon">
    <title>
        <Andrew Gorman /> Full-Stack Developer
    </title>
    <!-- Bootstrap css local -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <!-- Bootstrap css cdn -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <!-- Animate.css CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Swiper css cdn -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" /> -->

    <!-- My Styles -->
    <link rel="stylesheet" href="sass/main.css">

</head>
<style>
.home-link {
    box-shadow: 2px 2px 4px rgba(217, 202, 211, 0.8), -2px -2px 3px rgba(180, 190, 200, 0.7);
}
</style>

<body>
    <div class="hp-container">
        <!-- Navbar -->
        <?php require_once 'components/nav.php'; ?>
        <main>
            <!-- Main content HERO  -->
            <div class="intro-container p-2 w-75 border rounded shadow-lg d-flex justify-content-start align-items-start"
                style="height: 150px; margin:15px auto;">
                <div class="intro-img w-50">
                    <img src="main-img/me.jpg" class="border rounded-circle"
                        style="width: 6rem; height: 6rem; object-fit: cover;" alt="Andrew portfolio">
                </div>
                <div class="intro-text">
                    <p class="ms-2">I am an aspiring full-stack developer, jazz musician, mathematician and educator. I
                        recently completed four months of intesive training at the <a
                            href="https://codefactory.wien/en/home-en/" target="_blank">Code Factory</a> (Sept-Dec 2021)
                        in Vienna where
                        I live with my partner and two children. Below are links to some projects built during the
                        course that showcase my work on both the front and back ends. I graduated from Code Factory with
                        <i>summa cum laude</i> having achieved 100% in every assignment. So a letter of recommendation
                        from my trainers is also available.
                        <i><a href="creds/about.php">Continue reading...</a></i>
                    </p>
                </div>
            </div>
            <!-- SLIDING GRID -->
            <!-- Puzzle Grid Background-->
            <div class="container-fluid puzzle-bg-wrapper mb-5">
                <!-- Row -->
                <div class="row" id="puz-grid-bg">
                    <!-- Populate columns with JS -->
                </div>
            </div>
            <!-- Puzzle Grid Surface-->
            <div class="container-fluid puzzle-surface-wrapper mb-5">
                <!-- Row -->
                <div class="row" id="puz-grid-surf">
                    <!-- Populate columns with JS -->
                </div>
            </div>
        </main>

        <!-- Footer -->
        <?php require_once 'components/footer.php'; ?>
        <!-- ####################################################################### -->
        <!-- Bootstrap js local-->
        <script src="bootstrap/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap js cdn -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script> -->

        <!-- Swiper  js cdn -->
        <!-- <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script> -->
        <!-- My Scripts -->
        <script src="js/main.js"></script>
        <script src="js/swiper.js"></script>
    </div>
</body>

</html>