<?php 
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/codingforum/">Home</a>
      </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/codingforum/about.php">About</a>
        </li>
   
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Category
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/codingforum/contact.php">contact</a>
      </li>
    </ul>
    <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>';
    if(isset($_SESSION['loggedin']) && $_SESSION["loggedin"]==true){
      echo'
      <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginmodal">'.$_SESSION["username"].'</button>
      <a href="/codingforum/partials/logout.php"><button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signupmodal">Logout</button></a>
      ';
    }else{
      echo'
      <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
      <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signupmodal">signup</button>
      ';
    }

echo'
</div>
</div>
</nav>';

include 'loginmodal.php';
include 'signupmodal.php';
?>