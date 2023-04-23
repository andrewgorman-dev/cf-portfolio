 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light">
     <div class="container-fluid">
         <div class="brand-wrapper rounded d-flex justify-content-start align-items-center">
             <a href="index.php">
                 <img src="img/everest.jpeg" class="me-2 img-thumbnail rounded-circle brand-img" alt="">
             </a>
             <a class="navbar-brand text-light" href="index.php">
                 Mount Everest
             </a>
         </div>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
             aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavDropdown">
             <ul class="navbar-nav">
                 <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="index.php">Home</a>
                 </li>
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                         data-bs-toggle="dropdown" aria-expanded="false">
                         API
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                         <li>
                             <a class="dropdown-item" href="api/display_all.api.php">JSON</a>
                         </li>
                         <li>
                             <a class="dropdown-item" href="ajax_offers.html">Ajax Offers</a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link btn btn-outline-primary border rounded add-nav-btn" href="create.php">Add
                         Tour</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link btn btn-outline-dark border rounded ajax-nav-btn" href="ajax_offers.html">Ajax
                         Offers</a>
                 </li>
             </ul>
         </div>
     </div>
 </nav>