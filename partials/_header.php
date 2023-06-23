<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/learners2gether">LEARNERS <img class="zoom" src="img/two.png" alt="" width="35" height="35"> GETHER</a>
  
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/learners2gether">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
$sql = "SELECT category_name,category_id FROM  `categories`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  echo '<a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a>';
}
echo ' </div>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="contact.php" tabindex="-1" >Contact</a>
      </li>
    </ul>
    <div class="row mx-2">';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  echo '<form class="d-flex "method="get" action="search.php">
    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success" type="submit">Search</button></form>
</div>
     <p class="text-light my-0 mx-2 ">Welcome ' . $_SESSION['useremail'] . '</p>
     <a href="partials/_logout.php" class="btn btn-outline-success ml-2" >Logout</a>';
} else {
  echo '<form class="d-flex "method="get" action="search.php">
      <input class="form-control me-2"name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      </form>
  </div>
    <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
    <button class="btn btn-outline-success mx-2"  data-bs-toggle="modal" data-bs-target="#signupmodal">SignUp</button>';
}

echo '</div>   
</div>
</nav>';

include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true" && isset($_GET['alert']) && $_GET['alert'] == 'true') {
  echo '<div class="alert alert-success alert-dismissible fade show alert-fixed" id="inner-message" role="alert">
  <strong>Success-you can now log in</strong> .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false") {
  echo ' <div class="alert alert-warning alert-dismissible fade show alert-fixed" id="inner-message" role="alert">
           <strong>' . $_GET['error'] . '</strong> .
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
}


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true") {
  echo '<div class="alert alert-success alert-dismissible fade show alert-fixed" id="inner-message" role="alert">
           <strong>' . $_SESSION['useremail'] . '</strong> Welcome To Learners2Gether World.
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
}
if (isset($_GET['alert']) && $_GET['alert'] == "false") {
  echo '<div class="alert alert-danger alert-dismissible fade show alert-fixed" id="inner-message" role="alert">
           <strong>Please Enter</strong> Correct Email & Password.
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
}
