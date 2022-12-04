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

    $tid = getUserId($conn, $to_user);
    $to_id = $tid['usersid'];
    $umail = getUser($conn, $to_id);
    $to_email = $umail['usersEmail'];

    if ($user_id != $to_id) {
        insertInbox($conn, $user_id, $to_user, $ad_id);
        insertInbox($conn, $to_id, $from_id, $ad_id);
        sendMessage($conn, $message, $from_id, $to_user, $ad_id);

        //send message via email

        // $mail = new PHPMailer\PHPMailer\PHPMailer();

        // $output = '';

        // try {
        //     $mail->isSMTP();
        //     $mail->Host = 'smtp.gmail.com';
        //     $mail->SMTPAuth = true;
        //     // Gmail which you want to use as SMTP server
        //     $mail->Username = 'waris.aslami2@gmail.com';
        //     // Gmail Password
        //     $mail->Password = 'bryacazwdzovpopf';
        //     $mail->Port = 587;

        //     // email from which you want to send the email
        //     $mail->setFrom($user_email, $from_id);
        //     // Recipient Email
        //     $mail->addAddress($to_email);

        //     $mail->isHTML(true);
        //     $mail->Subject = "Test";
        //     $mail->Body = "This is a test email";

        //     $mail->send();
        //     $output = 'Sent';
        // } catch (Exception $e) {
        //     $output = '<div class="alert alert-danger">
        //               <h5>' . $e->getMessage() . '</h5>
        //             </div>';
        // }
    }
    header("location: ../msgs.php?from=$to_user&ad_id=$ad_id");
} else {
    header("location: ../inbox.php?error=feil");
    exit();
}