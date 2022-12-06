<?php
// Path: includes\createad.inc.php
session_start();

//if submit button is clicked
if (isset($_POST["submit"])) {

    //require necessary files
    require_once "dbh.inc.php";
    require_once 'functions.inc.php';
    require_once "PHPMailer/src/PHPMailer.php";
    require_once "PHPMailer/src/Exception.php";
    require_once "PHPMailer/src/SMTP.php";

    // // First we get the form data from the POST
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

    //get all users and their wants if there have notifs on
    $users = getAllUserWants($conn);
    //get the id of the ad we just created
    $ad_id = getLastAd($conn);

    //loop through the users with notifs on and send email to users who have wants that match the ad facilities
    foreach ($users as $user) {
        //Set match to false
        $match = false;

        //get the wants of the user and put them in an array
        $wants = explode(', ', $user['wants']);
        //get the email of the user
        $u = getUser($conn, $user['usersId']);
        $user_email = $u['usersEmail'];

        //loop through the wants and check if they match the ad facilities
        foreach ($wants as $want) {
            if (in_array($want, $fs)) {
                $match = true;
                break;
            }
        }
        //if there is a match, send email to user
        if ($match) {
            //message body
            $message = "Hei,\n\nVi har funnet en bolig som matcher dine ønsker. Du kan se den på denne linken: http://www.localhost/php/prosjekt/productpage.php?ad_id={$ad_id}\n\nMed vennlig hilsen,\nHybelleilighet.no";

            $mail = new PHPMailer\PHPMailer\PHPMailer();

            $output = '';

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;

                // Gmail which you want to use as SMTP server 
                $smtpMail = "CHANGE THIS TO YOUR SMTP EMAIL";
                $smtpPass = "CHANGE THIS TO YOUR SMTP EMAIL PASSWORD";

                $mail->Username =  'waris.aslami2@gmail.com';
                // Gmail Password
                $mail->Password =  'bryacazwdzovpopf';
                $mail->Port = 587;

                // email from which you want to send the email
                $mail->setFrom($smtpMail, 'Hybelutleie.no');
                // Recipient Email, TO TEST MAKE SURE YOUR USER EMAIL IS A VALID EMAIL
                $mail->addAddress($user_email);

                $mail->isHTML(true);
                $mail->Subject = "Hybelutleie.no - Ny melding";
                $mail->Body = $message;

                $mail->send();
                $output = 'Sent';
            } catch (Exception $e) {
                $output = '<div class="alert alert-danger">
               <h5>' . $e->getMessage() . '</h5>
             </div>';
            }
        }
    }

    //call functions to create ad and add facilities
    createAd($conn, $title, $leie, $boligtype, $antallrom, $areal, $etasje, $adresse, $postnr, $poststed, $leieperiode, $ledigfra, $info, $depositum, $usersId);
    addFacilities($conn, $fasiliteter);

    //get the id of the ad we just created
    $ad_id = getLastAd($conn);

    //call function to upload images with the ad id
    uploadAdImgs($conn, $_FILES, $ad_id);
    header("location: ../productpage.php?ad_id={$ad_id}");
} else {
    header("location: ../createad.php?error=noegikkgalt");
}
