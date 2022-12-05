<?php

$mail = new PHPMailer\PHPMailer\PHPMailer();

$output = '';

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    // Gmail which you want to use as SMTP server
    $mail->Username = 'waris.aslami2@gmail.com';
    // Gmail Password
    $mail->Password = 'bryacazwdzovpopf';
    $mail->Port = 587;

    // email from which you want to send the email
    $mail->setFrom($user_email, $from_id);
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
