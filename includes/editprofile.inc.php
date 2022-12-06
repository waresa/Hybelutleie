<?php
session_start();
if (isset($_POST["submit"])) {

    // First we get the form POST
    $name = $_POST["name"];
    $email = $_POST["email"];
    $oldPwd = $_POST["oldpwd"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $user_id = $_SESSION["userid"];
    $notif = $_POST["notif"];

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

    // Check if old password is correct
    if (oldPwdMatch($conn, $oldPwd, $user_id) !== false) {
        header("location: ../editprofile.php?error=wrongpwd");
        exit();
    }

    //We delete email before we check if it already exists in the database incase the user changes their email to an email that already exists
    deleteEmail($conn, $user_id);

    // Check if email already exists
    if (emailExists($conn, $email) !== false) {
        header("location: ../editprofile.php?error=emailtaken");
        exit();
    }

    // Now we edit the user info in the database by calling the function
    editUser($conn, $name, $email, $pwd, $notif, $user_id);

    //redirect to uprofile.php with error message
    header("location: ../uprofile.php?error=none");
} else {
    //change email back if error occurs
    changeEmail($conn, $user_id, $email);
    header("location: ../signup.php");
}
