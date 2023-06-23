<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

  <title>Welcome to learners2gether-</title>
  <style>
    .zoom {
      transition: all 0.5s;
    }

    .zoom:hover {
      transform: scale(1.3);
    }

    .container {
      display: flex;
      align-items: center;
      text-align: center;
      height: 80vh;
    }
  </style>
</head>

<body>
  <?php include 'partials/_dbconnect.php'; ?>
  <?php include 'partials/_header.php'; ?>

  <div class="container py-3">
    <div class="card">
      <div class="card-body">
        <h1>Learners2Gether</h1>
        <hr>
        <p>
          This project is designed so as to be used by E-Learning specializing in solving the problem to users. It is an online website through which users can view solutions and users can also ask problems or doubts. The website should allow new users to register online. Website allows the users to use the system to find the solutions. This is a web-based system that allow users to register and view the other user solutions and ask the solution for the problem. Website also helps user’s task whenever they need solution to the problem. Considered the level of knowledge possessed by the users of this website, a simple but quality user interface should be developed to make it easy to understand and required less training
        </p>
      </div>
    </div>
  </div>


  <?php include 'partials/_footer.php'; ?>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
</body>

</html>