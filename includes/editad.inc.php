<?php
session_start();

//if submit button is clicked
if (isset($_POST["submit"])) {

    //get files needed
    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    // // First we get the form data from the POST
    $ad_id = $_POST["ad_id"];
    $title = $_POST["title"];
    $leie = $_POST["leie"];
    $boligtype = $_POST["boligtype"];
    $antallrom =  $_POST["antallrom"];
    $areal = $_POST["areal"];
    $etasje = $_POST["etasje"];
    $adresse = $_POST["adresse"];
    $postnr = $_POST["postnr"];
    $poststed = $_POST["poststed"];
    $leieperiode = $_POST["leieperiode"];
    $ledigfra = $_POST["ledigfra"];
    $depositum = $_POST["depositum"];
    $info = $_POST["info"];

    //call function to edit ad
    editAd($conn, $title, $leie, $boligtype, $antallrom, $areal, $etasje, $adresse, $postnr, $poststed, $leieperiode, $ledigfra, $depositum, $info, $ad_id);

    //redirect to myads.php with error message
    header("location: ../productpage.php?ad_id=$ad_id");
} else {
    header("location: ../editad.php?ad_id=$ad_id?error=noegikkgalt");
    exit();
}
