<?php
session_start();

if (isset($_POST["submit"])) {

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    // // First we get the form data from the URL
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
    $fs = $_POST["fasiliteter"];
    $fasiliteter = implode(", ", $fs);
    $usersId = $_SESSION['userid'];

    createAd($conn, $title, $leie, $boligtype, $antallrom, $areal, $etasje, $adresse, $postnr, $poststed, $leieperiode, $ledigfra, $info, $depositum, $usersId);
    addFacilities($conn, $fasiliteter);

    $ad_id = getLastAd($conn);

    uploadAdImgs($conn, $_FILES, $ad_id);
} else {
    header("location: ../signup.php");
    exit();
}
