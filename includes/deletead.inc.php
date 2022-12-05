<?php

if (isset($_POST["submit"])) {

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    // // First we get the form data from the URL
    $ad_id = $_POST["ad_id"];

    deleteAd($conn, $ad_id);
    echo $ad_id;
} else {
    header("location: ../productpage.php=ad_id=$ad_id?error=noegikkgalt");
    exit();
}
