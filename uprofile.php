<?php
include_once 'includes/functions.inc.php';
include_once 'includes/dbh.inc.php';
include_once 'header.php';

//if user is not logged in, redirect to login
if (!isset($_SESSION["userid"])) {
    header("location: login.php");
}

//if user is logged in, set the user id
$user_id = $_SESSION["userid"];

//get user info to show on profile page
$user = getUser($conn, $user_id);
$user_email = $user['usersEmail'];
$user_name = $user['usersName'];
$notif = $user['notif'];

?>


<div class="card">
    <h2 class="hvdg">Min profil</h2>
    <h1>Brukernavn: <?php echo ucfirst($user_name); ?></h1>
    <p>E-post: <?php echo $user_email; ?></p>
    <p>Passord: *************</p>
    <p>Varslinger:
        <?php
        if ($notif == 1) {
            echo "På";
        } else {
            echo "Av";
        }
        ?>
    </p>
    <br>
    <a href="editprofile.php"><button type="submit">Rediger info</button></a>
</div>



<?php

include_once 'footer.php';
