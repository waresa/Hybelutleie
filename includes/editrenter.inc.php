<?php
session_start();

//if submit button is clicked
if (isset($_POST["submit"])) {

    //get files needed
    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    //get user id from session
    $usersId = $_SESSION['userid'];

    // // First we get the form data from the POST
    $budget = $_POST["budget"];
    $ws = $_POST["fasiliteter"];

    //convert array ws to string using implode
    $wants = implode(", ", $ws);

    //call function to edit ad
    editRenter($conn, $budget, $wants, $usersId);

    //redirect to editrenter.php with error message
    header("location: ../leietakerprofil.php?error=none");
} else {
    header("location: ../leietakerprofil?user_id=$usersId?error=noegikkgalt");
}
