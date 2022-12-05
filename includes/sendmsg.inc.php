<?php
session_start();

if (isset($_POST["submit"])) {

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';
    require_once "PHPMailer/src/PHPMailer.php";
    require_once "PHPMailer/src/Exception.php";
    require_once "PHPMailer/src/SMTP.php";


    // // First we get the form data from the URL
    $message = $_POST["message"];
    $from_id = $_SESSION["username"];
    $user_id = $_SESSION["userid"];
    $user_email = $_SESSION["useremail"];
    $to_user = $_POST["toid"];
    $ad_id = $_POST["adid"];

    // get receiver email and id
    $tid = getUserId($conn, $to_user);
    $to_id = $tid['usersid'];
    $umail = getUser($conn, $to_id);
    $to_email = $umail['usersEmail'];

    //get receiver notif 
    $notif = $umail['notif'];

    //if receiver is not the same as sender
    if ($user_id != $to_id) {
        insertInbox($conn, $user_id, $to_user, $ad_id);
        insertInbox($conn, $to_id, $from_id, $ad_id);
        sendMessage($conn, $message, $from_id, $to_user, $ad_id);

        // // //send message via email if
        if ($notif == 1) {
            require 'sendmail.inc.php';
        }
    }
    header("location: ../msgs.php?from=$to_user&ad_id=$ad_id");
} else {
    header("location: ../inbox.php?error=feil");
    exit();
}
