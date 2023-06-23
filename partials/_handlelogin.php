<?php
$showError = "false";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '_dbconnect.php';
  $email = strtolower($_POST['lemail']);
  $pass = $_POST['lpass'];

  $sql = "select * from users where user_email='$email'";
  $result = mysqli_query($conn, $sql);
  $numRows = mysqli_num_rows($result);
  if ($numRows == 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($pass, $row['user_pass'])) {
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['sno'] = $row['sno'];
      $_SESSION['useremail'] = $email;
      $showError = "true";
      header("Location: /learners2gether/index.php?alert=" . $showError . "");
    } else {
      $showError = "false";
      header("Location: /learners2gether/index.php?alert=" . $showError . "");
    }
  }
}
