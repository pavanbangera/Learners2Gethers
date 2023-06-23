<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin = $_POST['admin'];
    $password = $_POST['password'];
    if ($admin == 'admin' && $password == 'password') {
        session_start();
        $_SESSION['loggedin'] = true;
        header("Location:admin.php");
    } else {
        header("Location:login.php");
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        .container {
            width: 30%;
            box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
            margin-top: 10%;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <form action="" method="post">
            <h1 class="text-center">Admin</h1>
            <hr>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label ">
                    <h6>Name</h6>
                </label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="admin" placeholder="Enter Your Name">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">
                    <h6>Password</h6>
                </label>
                <input type="password" class="form-control" id="exampleFormControlInput1" name="password" placeholder="Enter Your Password">
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-success mb-3">Done</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>