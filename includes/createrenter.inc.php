<?php
session_start();

if (isset($_POST["submit"])) {

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    // // First we get the form data from the URL
    $budget = $_POST["budget"];
    $ws = $_POST["fasiliteter"];
    $wants = implode(", ", $ws);

    $usersId = $_SESSION['userid'];

    createRenter($conn, $budget, $wants, $usersId);
} else {
    header("location: ../signup.php");
    exit();
}
