<?php

// Connect to DB
require_once 'includes/db_connect.inc.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM locations WHERE loc_id = {$id};";
    $res = mysqli_query($connect, $sql);
    if (mysqli_num_rows($res) == 1) {
        $data = mysqli_fetch_assoc($res);
        $loc = $data['location_name'];
        $price = $data['price'];
        $desc = $data['description'];
        $activ = $data['activities'];
        $lat = $data['latitude'];
        $lng = $data['longitude'];
        $date = $data['created_at'];
        $pic = $data['picture'];
        $coordinates = $lat . "," . $lng;
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title><?php echo ucwords($loc) ?> Details</title>
    <link rel="shortcut icon" href="img/everest.jpeg" type="image/x-icon">
    <!-- Bootstrap css cdn -->
    <?php require_once 'includes/bootstrap_css.inc.php'; ?>
    <!-- Additional sass -->
    <link rel="stylesheet" href="sass/main.css">
</head>

<body>
    <div class="show-details-container">
        <!-- Navbar -->
        <?php require_once 'includes/nav_root.inc.php'; ?>
        <!--  Display Card -->
        <div class="container w-75 mt-3 inside-details">
            <h2 class="p-2 details-title text-light">Your guide to <?php echo ucwords($loc) ?></h2>
            <div class="card m-auto mb-3 border rounded dispCard" style="max-width: 70vw;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="img/<?= $pic ?>" class="img-fluid rounded-start cardImg"
                            alt="<?php echo ucwords($loc) ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ucwords($loc) ?></h5>
                            <p class="cardDesc"><?php echo $desc ?></p>
                            <hr>
                            <p class="card-price">Tour Price $<?php echo $price ?></p>
                            <hr>
                            <p class="card-price">Top Activities: <?php echo $activ ?></p>
                            <p class="card-date">
                                <?= 'This tour was first made available on ' . strtolower($date) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="map-title mt-3 text-light"><?php echo ucwords($loc) ?> is located here:</h3>
            <div class="map">
                <div class="map-wrap me-4">
                    <div id="map" class="mt-3 mb-4"></div>
                </div>
                <div class="travel-details text-light">
                    <ul style="list-style: none;">
                        <li>
                            <a href="#">
                                <img src="img/travel.jpeg" class="img-thumbnail rounded-circle" height="40" alt="">
                                Travel
                                Info
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="#">
                                <img src="img/accom.jpeg" class="img-thumbnail rounded-circle" height="40" alt="">
                                Accommodation
                            </a>
                        </li>
                        <br>
                        <li>
                            <a href="#">
                                <img src="img/hike.jpeg" class="img-thumbnail rounded-circle" height="40" alt=""> Guided
                                Hiking Tours
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container text-center m-auto">
            <form id="form">

                <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                <input type="hidden" id="lat" name="lat" value="<?php echo $lat ?>">
                <input type="hidden" id="lng" name="lng" value="<?php echo $lng ?>">
                <input type="submit" value="Check weather in <?php echo $loc ?>"
                    class="btn btn-lg btn-info text-light weatherBtn">

            </form>
            <div id="weather-card" class="p-3 m-auto weather-card">

            </div>
        </div>
        <?php require_once 'includes/footer.php'; ?>
    </div>
    <!-- Bootstrap js cdn -->
    <?php require_once 'includes/bootstrap_js.inc.php'; ?>

    <!-- JS Google-Maps API -->
    <script>
    var map;

    function initMap() {
        var <?php echo ucwords($loc) ?> = {
            lat: <?php echo $lat ?>,
            lng: <?php echo $lng ?>
        };
        map = new google.maps.Map(document.getElementById('map'), {
            center: <?php echo ucwords($loc) ?>,
            zoom: 8
        });
        var pinpoint = new google.maps.Marker({
            position: <?php echo ucwords($loc) ?>,
            map: map
        });
    }
    </script>

    <!-- Ajax weather -->
    <script>
    document.getElementById("form").addEventListener("submit", getWeather);
    //POST with Inserting user into db
    function getWeather(e) {
        e.preventDefault(); //this prevents the page from refreshing after submitting
        let lat = document.getElementById("lat").value; //saving the firstname value
        let lng = document.getElementById("lng").value; //saving the lastname value
        let params = `lat=${lat}&lng=${lng}`; //creating the parameters for the POST method
        console.log(params)
        let request = new XMLHttpRequest(); //creating new request
        request.open("POST", "api/weather.api.php", true); //connecting to the process.php file
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //setting header for POST method
        request.onload = function() {
            if (this.status == 200) {
                // console.log(this.responseText)
                document.getElementById('weather-card').innerHTML = this.responseText;
            }
        }
        request.send(params); //send parameters to be further processed by php

    }
    </script>

    <!-- Google API Key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtjaD-saUZQ47PbxigOg25cvuO6_SuX3M&callback=initMap"
        async defer></script>
</body>

</html>