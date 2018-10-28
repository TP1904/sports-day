<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Title</title>
  <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="styles/main.css" />
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" id="home">
            <a class="nav-link" href="index.php">Home</a>
          </li>
        <?php
          if (isset($_SESSION["account_type"])){
            if ($_SESSION["account_type"] == "Teacher"){
              include "teachers.php";
            } elseif($_SESSION["account_type"] == "Student") {
              include "students.php";
            }
          } else{
            include "loggedout.php";
          }
        ?>
      </div>
    </nav>
  </header>
