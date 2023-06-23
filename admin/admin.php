<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:login.php");
  exit;
}
$insert = false;
$update = false;
$delete = false;
include '../partials/_dbconnect.php';

if (isset($_GET['delete'])) {
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `categories` WHERE `category_id` = '$sno'";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $category_name = $_POST["category_name"];
  $category_decription = $_POST["category_decription"];
  $explore_link = $_POST["explore_link"];
  //insert
  $sql = "INSERT INTO `categories` (`category_name`, `category_decription`, `explore_link`, `created`) VALUES ('$category_name', '$category_decription', '$explore_link', current_timestamp())";
  $result = mysqli_query($conn, $sql);
  //add new
  if ($result) {
    //echo "The record inserted successfully!";
    $insert = true;
  } else {
    echo "The record not inserted successfully because of this error---->" . mysqli_error($conn);
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">



  <title>Admin</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <div class="container-fluid">
      <a class="navbar-brand px-3" href="#">Learners2Gether</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <form action="_logout.php" class="d-flex" role="search">
        <button class="btn btn-outline-success px-3" type="submit">Logout</button>
      </form>
    </div>
    </div>
  </nav>
  <?php

  if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>success!</strong> Your note inserted successfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>success!</strong> Your note updated successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>success!</strong> Your note deleted successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }

  ?>
  <div class="container my-4">
    <h2>Add New Discussion</h2>
    <form action="#" method="post">
      <div class="mb-3">
        <label for="category_name"><b> Name</b></label>
        <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="emailHelp" required>
      </div>
      <div class="mb-3">
        <label for="category_decription"><b> Discription</b></label>
        <textarea class="form-control" id="category_decription" name="category_decription" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label for="explore_link"><b>Explore Link</b></label>
        <input type="text" class="form-control" id="explore_link" name="explore_link" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary"><b>Add</b></button>
    </form>
  </div>
  <div class="container my-4">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">category_id</th>
          <th scope="col">name</th>
          <th scope="col">description</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
       <th scope='row'>" . $sno . "</th>
       <td>" . $row['category_name'] . "</td>
       <td>" . $row['category_decription'] . "</td>
       <td> <button class='delete btn btn-sm btn-danger'id=d" . $row['category_id'] . ">DELETE</button> </td>
</tr>";
        }

        ?>
      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        category_id = e.target.id.substr(1, );

        if (confirm("Are you sure you want Delete this file")) {
          window.location = `/learners2gether/admin/admin.php?delete=${category_id}`;
        } else {}
      })
    })
  </script>
</body>

</html>