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

    $notif = $_POST["notif"];

    $doesNotHaveProfile = getRenter($conn, $usersId);
    if ($doesNotHaveProfile != false) {
        editRenter($conn, $budget, $wants, $usersId);
    } else {
        createRenter($conn, $budget, $wants, $usersId);
    }
    changeNotif($conn, $notif, $usersId);
    header("location: ../leietakerprofil.php?error=none");
} else {
    header("location: ../signup.php");
    exit();
}
