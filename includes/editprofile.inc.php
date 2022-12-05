<?php
session_start();
if (isset($_POST["submit"])) {

    // First we get the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $oldPwd = $_POST["oldpwd"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $user_id = $_SESSION["userid"];
    $notif = $_POST["notif"];

    // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
    // These functions can be found in functions.inc.php

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
    if (emptyInputSignup($name, $email, $pwd, $pwdRepeat) !== false) {
        header("location: ../editprofile.php?error=emptyinput");
        exit();
    }

    // Proper email chosen
    if (invalidEmail($email) !== false) {
        header("location: ../editprofile.php?error=invalidemail");
        exit();
    }
    // Do the two passwords match?
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../editprofile.php?error=passwordsdontmatch");
        exit();
    }

    deleteEmail($conn, $user_id);

    if (emailExists($conn, $email) !== false) {
        header("location: ../editprofile.php?error=emailtaken");
        exit();
    }
    // Now we edit the user info in the database
    editUser($conn, $name, $email, $pwd, $notif, $user_id);
    header("location: ../uprofile.php?error=none");
} else {
    //change email back if error
    changeEmail($conn, $user_id, $email);
    header("location: ../signup.php");
    exit();
}
