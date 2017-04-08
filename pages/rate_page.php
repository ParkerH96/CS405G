<!--
  Team Databased 2017: Movie-DB
  Author(s): Parker Householder, David Cottrell

  Name: add_page.php

  Description: This file contains the PHP code used for adding a MOVIE into the
  database. It also contains the main HTML code for laying out the Add a Movie page.

-->
<!DOCTYPE html>
<html>
  <head>
    <title> Movie-db </title>
    <meta charset="UTF-8">

    <!-- fix for viewport scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- include bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- include stylesheets -->
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="stylesheet" href="../css/main_page.css" type="text/css">
    <link rel="stylesheet" href="../css/add_page.css" type="text/css">

    <?php
      include '../functions/session.php';

      if(isset($_GET['movie_id']) && !empty($_GET['movie_id']) && isset($_GET['search']) && !empty($_GET['search'])){
        $c_movie_id = $_GET['movie_id'];
        $search = $_GET['search'];
      }
      else {
        header("location: main_page.php");
      }

      if(!empty($_POST)){

        //connect to the database
        include '../functions/connection.php';

        //escape the strings
        $rating = $mysqli->escape_string($_POST['rating']);
        $review = $mysqli->escape_string($_POST['review']);

        $insertion_query = $mysqli->query("INSERT INTO user_actions VALUES ($user_id, $c_movie_id, $rating, '$review')");

        if($insertion_query){

          $_SESSION['status'] = 'Success';
          $_SESSION['message'] = 'Success! You review has been added. Thank you for your feedback!';

          //success! redirect them back to the main page
          header("location: ../pages/main_page.php?option=Title&search=$search&submit=Search");
        }
        else {
          die("Error.");
        }

      }
    ?>
  </head>
<body>
  <div class="container">
    <div class="row shadow">
      <div class="main-page-title">
        <h1>Movie-DB</h1>
      </div>
      <div id="tool-bar">
        <?php
          if($admin_tag == 1){
            echo
             '<div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                  Manager
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="users_page.php">View Users</a></li>
                  <li><a href="add_page.php">Add a Movie</a></li>
                  <li><a href="#">Add a Crew</a></li>
                  <li><a href="#">Delete a Crew</a></li>
                  <li><a href="#">Edit a Crew</a></li>
                </ul>
              </div>';
          }
        ?>
        <div class="dropdown">
          <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
            User
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
             <li><a href="main_page.php">Search Movies</a></li>
             <li><a href="#">Tag a Movie</a></li>
             <li><a href="#">Rate and comment</a></li>
          </ul>
        </div>
        <span class="greeting"><?php echo 'Hello, ' . $first_name . ' ' . $last_name; ?></span>
        <button type="button" class="btn btn-danger logout"><a href="../login.php">Logout</a></button>
      </div>
    </div>
    <div class= "row page-content">
      <div class="col-md-3"></div>
      <div class="col-xs-12 col-md-6">
        <form method="post" action="">
          <input type="number" min="0" max="10" name="rating" required><br>
          <textarea name="review" rows="4" cols="50"></textarea><br>
          <input type="submit" name="submit" value="Rate Now">
        </form>
      </div>
      <div class="col-md-3"></div>
    </div>
  </body>
</html>