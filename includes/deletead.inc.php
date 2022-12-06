<?php

//if submit button is clicked
if (isset($_POST["submit"])) {

    //get files needed
    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    // // First we get the form data from the POST
    $ad_id = $_POST["ad_id"];

    //call function to delete ad
    deleteAd($conn, $ad_id);

    //redirect to myads.php with error message
    header("location: ../myads.php?error=none");
} else {
    header("location: ../productpage.php=ad_id=$ad_id?error=noegikkgalt");
}
