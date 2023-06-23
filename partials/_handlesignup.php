<?php
$showError = "false";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $user_email = strtolower($_POST['signup']);
    $pass = $_POST['spassword'];
    $cpass = $_POST['scpassword'];

    //checking email exist
    $existSql = "select * from users where user_email='$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
        $showError = "Email already in use";
        header("Location:/learners2gether/index.php?signupsuccess=false&error=$showError");
    } else {
        if ($pass == $cpass) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
                header("Location:/learners2gether/index.php?signupsuccess=true");
                exit();
            }
        } else {
            $showError = "Passwords do not match";
            header("Location:/learners2gether/index.php?signupsuccess=false&error=$showError");
        }
    }
}
