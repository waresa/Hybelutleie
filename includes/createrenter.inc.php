<?php
session_start();

if (isset($_POST["submit"])) {

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    // // First we get the form data from the URL
    $fname = $_POST["fname"];
    $age = $_POST["age"];
    $budget = $_POST["budget"];
    $leiefra = $_POST["leiefra"];
    $ws = $_POST["fasiliteter"];
    $wants = implode(", ", $ws);
    $info = $_POST["info"];

    $usersId = $_SESSION['userid'];

    createRenter($conn, $fname, $age, $budget, $leiefra, $wants, $info, $usersId);
} else {
    header("location: ../signup.php");
    exit();
}
