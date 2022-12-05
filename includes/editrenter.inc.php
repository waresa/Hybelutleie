<?php
session_start();

if (isset($_POST["submit"])) {

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    $usersId = $_SESSION['userid'];

    // // First we get the form data from the URL
    $fname = $_POST["fname"];
    $age = $_POST["age"];
    $budget = $_POST["budget"];
    $leiefra = $_POST["leiefra"];
    $ws = $_POST["fasiliteter"];
    $wants = implode(", ", $ws);
    $info = $_POST["info"];

    editRenter($conn, $fname, $age, $budget, $leiefra, $wants, $info, $usersId);
    header("location: ../adlist.php");
} else {
    header("location: ../editrenter.php?user_id=$usersId?error=noegikkgalt");
    exit();
}
