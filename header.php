<?php
session_start();
include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>PHP Project 01</title>
  <!--I won't do more than barebone HTML, since this isn't an HTML tutorial.-->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style1.css">
</head>

<body>

  <!--A quick navigation-->
  <nav>
    <div class="wrapper">
      <a href="index.php"><img src="img/uia.png" alt="UiA logo"></a>
      <ul>
        <li><a href="index.php">Hjem</a></li>
        <li><a href="hybler.php">Hybler</a></li>
        <?php
        if (isset($_SESSION["userid"])) {
          echo "<li><a href='uprofile.php'>Profil</a></li>";
          echo "<li><a href='logout.php'>Logg ut</a></li>";
        } else {
          echo "<li><a href='signup.php'>Registrer</a></li>";
          echo "<li><a href='login.php'>Logg inn</a></li>";
        }
        ?>
      </ul>
    </div>
  </nav>

  <!--A quick wrapper to align the content (ends in footer.php)-->
  <div class="wrapper">