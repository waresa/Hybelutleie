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

        //send message via email if receiver has notif on
        if ($notif == 1) {
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            $output = '';

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;

                // Gmail which you want to use as SMTP server 
                $smtpMail = "CHANGE THIS TO YOUR SMTP EMAIL";
                $smtpPass = "CHANGE THIS TO YOUR SMTP EMAIL PASSWORD";

                $mail->Username = 'waris.aslami2@gmail.com';
                // Gmail Password
                $mail->Password = 'bryacazwdzovpopf';
                $mail->Port = 587;

                // email from which you want to send the email
                // Name is optional
                $mail->setFrom($smtpEmail, $from_id);
                // Recipient Email
                $mail->addAddress($to_email);

                $mail->isHTML(true);
                $mail->Subject = "Hybelutleie.no - Ny melding";
                $mail->Body = "Du har fått en ny melding på Hybelutleie.no. Logg inn for å lese den.";

                $mail->send();
                $output = 'Sent';
            } catch (Exception $e) {
                $output = '<div class="alert alert-danger">
               <h5>' . $e->getMessage() . '</h5>
             </div>';
            }
        }
    }

    //redirect to message page
    header("location: ../msgs.php?from=$to_user&ad_id=$ad_id");
} else {
    header("location: ../inbox.php?error=feil");
}
