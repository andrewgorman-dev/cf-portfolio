<?php
session_start();


if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Media By Type (CD)</title>
    <!-- Bootstrap CSS-->
    <?php require_once '../includes/bootstrap_css.inc.php'; ?>
    <!-- Styles -->
    <link rel="stylesheet" href="../sass/prod_styles.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <div class="brand-wrapper p-2 border d-flex justify-content-start align-items-center">
                <a href='<?php if (isset($_SESSION['adm'])) {
                                echo "../dashboard.php";
                            } else {
                                echo "../home.php";
                            } ?>'>
                    <img src="../pictures/lamp-logo.png" height="56" alt="">
                </a>
                <a class="navbar-brand nav-brand-text" href='<?php if (isset($_SESSION['adm'])) {
                                                                    echo "../dashboard.php";
                                                                } else {
                                                                    echo "../home.php";
                                                                } ?>'>LAMP Libraries</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav w-50 d-flex justify-content-evenly align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href='<?php if (isset($_SESSION['adm'])) {
                                                                            echo "../dashboard.php";
                                                                        } else {
                                                                            echo "../home.php";
                                                                        } ?>'>ACCOUNT HOME</a>
                    </li>
                    <!-- ADD LINK FOR ADMIN ONLY -->
                    <?php if (isset($_SESSION['adm'])) {
                        echo "<li class='nav-item'>
                                <a class='nav-link' aria-current='page' href='product_create.php'>ADD MEDIA</a>
                            </li>";
                    } ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            SORT
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="product_index.php#pubList">Sort by Publisher</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Sort by Type</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- MAIN -->
    <main>
        <!-- LOGOUT BUTTON -->
        <div class="btn-container mt-2 me-3 float-end">
            <a class="btn btn-outline-warning  p-2" href="../logout.php?logout">Log out</a>
        </div>

        <!-- CDs ONLY PHP cURL Method -->
        <div class="container typeAPIContainer">
            <h3 class="text-light mt-3">Cds-only API (php cURL)</h3>
            <div class="row">
                <?php
                require_once '../api_cd/REST.api.php';
                $url_cd = "http://andrew.codefactory.live/CrudLibrary/api_cd/display_cd.api.php";
                $result = curl_get($url_cd);
                $media_cd = json_decode($result);
                // var_dump($media_cd->data);
                $cd = $media_cd->data;
                $output = "";
                foreach ($cd as $c) {
                    $output .= "<div class='col-lg-4 col-md-6 col-sm-12 gy-3'> 
                <div class='card shadow' style='width: 18rem;'>
                    <img src='../pictures/{$c->pic}' class='card-img-top' style='height: 12rem; width: 100%; object-fit: cover;'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$c->title}</h5>
                        <hr/>
                        <p class='card-text'>{$c->description}</p>
                        <hr/>
                        <a href='show.php?id={$c->id}'>
                            <button class='m-1 btn btn-outline-info btn-sm action-btn' type='button'>Show Media</button>
                        </a>
                    </div>
                </div>
            </div>";
                }
                echo $output;

                ?>
            </div>
        </div>
        <hr class="text-light">
        <hr class="text-light">
        <!-- AJAX Method -->
        <div class="container ajax-container">
            <h3 class="text-info">Cds-only API (Ajax)</h3>
            <button id="cdBtn" class="btn btn-outline-info border rounded mt-3 mb-3 shadow p-3">Show CDs</button>
            <div class="row mt-4 text-center" id="cd">
                <!-- Populate with Javascript -->
            </div>
        </div>
    </main>
    <!-- AJAX Javascript -->
    <script>
    const cdBtn = document.getElementById('cdBtn');
    cdBtn.addEventListener("click", getCds, false);

    function getCds() {
        const req = new XMLHttpRequest();
        req.open("GET", "../api_cd/display_cd.api.php", true);
        req.onload = function() {
            if (req.status == 200) {
                let media_cd = JSON.parse(req.responseText);
                console.log(media_cd);
                console.log(media_cd.data);
                let output = "";
                for (let c of media_cd.data) {
                    output
                        += `<div class='col-lg-4 col-md-6 col-sm-12 gy-3'> 
                                <div class='card shadow' style='width: 18rem;'>
                                    <img src='../pictures/${c.pic}' class='card-img-top' style='height: 12rem; width: 100%; object-fit: cover;'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>${c.title}</h5>
                                        <hr/>
                                        <p class='card-text'>${c.description}</p>
                                        <hr/>
                                        <a href='show.php?id=${c.id}'>
                                            <button class='m-1 btn btn-outline-info btn-sm action-btn' type='button'>Show Media</button>
                                        </a>
                                    </div>
                                </div>
                            </div>`;
                }
                document.getElementById('cd').innerHTML = output;
            }
        }
        req.send();
    }
    </script>
    <!-- Bootstrap JS-->
    <?php require_once '../includes/bootstrap_js.inc.php'; ?>
</body>

</html>