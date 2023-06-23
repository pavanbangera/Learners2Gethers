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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_decription'];
        $explore_cat = $row["explore_link"];
    }

    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        //insert thread into db
        $th_title = $_POST['title'];
        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);
        $th_desc = $_POST['desc'];
        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);
        $asked_by = $_SESSION['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$asked_by', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo
            ' <div class="alert alert-success" role="alert">
                <b> Success-your thread been added</b>.

      </div>';
        }
    }

    ?>


    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcom to <?php echo $catname; ?> World.</h4>
            <p><?php echo $catdesc; ?></p>
            <?php echo '  <a class="btn btn-primary btn-lg" href="' . $explore_cat . '" target="_blank" role="button"> learn more</a>'; ?>
            <hr>
            <p class="mb-0">This is a peer to peer Discussion platform.No Spam / Advertising /Self-promote in the learners2gethers is not
                allowed.Do not post
                copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <br>

        </div>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container">
        <h1 class="py-2">Start a Discussion</h1>
        <div class="container">
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Short as possible.</div>
                </div>
                <label for="exampleFormControlTextarea1" class="form-label">Elaborate Your Problem</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-success mb-3 mx-3">Submit</button>
        </form>
    </div>';
    } else {
        echo '<div class="container">
     <h1 class="py-2">Start a Discussion</h1>
     <p class="lead" > You are not logged in .Please login to be able to start a Discussion.</p>
     </div>';
    }
    ?>


    <div class="container">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            $sqlcomment = "SELECT * FROM `comments` where thread_id='$id'";
            $resultcomment = mysqli_query($conn, $sqlcomment);
            $rowsOfComment = mysqli_num_rows($resultcomment);

            echo  '<div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="img/userlogo.png" width="34px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
            
                <h5 class="mt=0"><a class="text-dark" href="thread.php?threadid=' . $id . '">' . substr($title, 0, 60) . '...</a></h5>
                ' . substr($desc, 0, 100) . '... </div> <p class="font-weight-bold my-0" > <i class="fa-solid fa-comment-dots"></i> <b>' . $rowsOfComment . ' &nbsp; </b> <b>Asked by :' . $row2['user_email'] . ' at ' . $thread_time . '</b></p>
            
        </div>';
        }

        if ($noResult) {
            echo '<div class="container">
          <div class="alert alert-warning" role="alert">
          <b> be the first person to ask a question</b>.
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