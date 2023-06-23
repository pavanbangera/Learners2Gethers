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
    </style>
    <script src="https://kit.fontawesome.com/bc9f1fb150.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        //find name of posted by main

        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        //insert comment into db
        $c_comment = $_POST['comment'];
        $c_comment = str_replace("<", "&lt;", $c_comment);
        $c_comment = str_replace(">", "&gt;", $c_comment);
        $comment_by = $_POST['sno'];
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$c_comment', '$id', '$comment_by', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo
            ' <div class="alert alert-success" role="alert">
                <b> Success-your comment been added</b>.

      </div>';
        }
    }

    ?>


    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"><?php echo $title; ?></h4>
            <p><?php echo $desc; ?></p>
            <hr>
            <p class="mb-0">This is a peer to peer learners2gether.No Spam / Advertising /Self-promote in the learners2gethers is not
                allowed.Do not post
                copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>

            <p>Poster by:<b><?php echo $posted_by; ?></b></p>
        </div>
    </div>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container">
        <h1 class="py-2">Post a comment</h1>
        <div class="container">
            <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                <div class="mb-3">

                    <label for="exampleFormControlTextarea1" class="form-label">Type your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    <input type="hidden" name="sno" value="' .  $_SESSION["sno"] . '">
                    <br>
                    <button type="submit" class="btn btn-success mb-3 mx-3">Post Comment</button>
            </form>
        </div>
    </div>';
    } else {
        echo '<div class="container">
        <h1 class="py-2">Post a comment</h1>
        <p class="lead" > You are not logged in .Please login to be able to post a comment.</p>
        </div>';
    }
    ?>


    <div class="container">
        <!-- <div class="flex-grow-1 ms-3">

            <h1 class="mt=0">Discussions</h1>
            <p class="font-weight-bold my-0"> <i class="fa-solid fa-comment-dots"></i> <b>' . $rowsOfComment . ' &nbsp; </b> </p>

        </div> -->
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $rowsOfComment = mysqli_num_rows($result);
        echo '
        <div class="d-flex">
            <div class="p-2 flex-grow-1">
                <h1 class="mt=0">Discussions</h1>
            </div>
            <div class="p-2">
                <h3 class="font-weight-bold my-0"> <i class="fa-solid fa-comment-dots"></i> <b>' . $rowsOfComment . ' &nbsp; </b> </h3>
            </div>
        </div>';


        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $thread_user_id = $row['comment_by'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);


            echo  '

          <div class="d-flex my-3">
           <div class="flex-shrink-0">
               <img src="img/userlogo.png" width="34px" alt="...">
           </div>
           <div class="flex-grow-1 ms-3">
            <p class="font-weight-bold my-0"><b>' . $row2['user_email'] . ' at ' . $comment_time . '</b></p>
               ' . $content . '
           </div>
       </div>';
        }


        if ($noResult) {
            echo '<div class="container">
        <div class="alert alert-warning" role="alert">
        <b> No Comments found</b>.
</div>
</div>
</div>';
        }
        ?>


        <?php include 'partials/_footer.php'; ?>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
</body>

</html>