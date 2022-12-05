<?php
session_start();

if (isset($_POST["submit"])) {

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    $usersId = $_SESSION['userid'];

    // // First we get the form data from the URL
    $budget = $_POST["budget"];
    $ws = $_POST["fasiliteter"];
    $wants = implode(", ", $ws);

    editRenter($conn, $budget, $wants, $usersId);
    header("location: ../adlist.php");
} else {
    header("location: ../editrenter.php?user_id=$usersId?error=noegikkgalt");
    exit();
}
