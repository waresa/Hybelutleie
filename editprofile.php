<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php';
include_once 'includes/functions.inc.php';

if (!isset($_SESSION["userid"])) {
    header("location: login.php");
}

$user_id = $_SESSION["userid"];
$user = getUser($conn, $user_id);
$user_email = $user['usersEmail'];
$user_name = $user['usersName'];

?>

<section class="signup-form">
    <h2 class="hvdg">Endre din informasjon</h2>
    <div class="signup-form-form">
        <form action="includes/editprofile.inc.php" method="post">
            <label for="name">Ditt brukernavn</label>
            <input type="text" name="name" placeholder="Fult Navn" value="<?php echo $user_name; ?>">
            <label for="email">E-post</label>
            <input type="text" name="email" placeholder="Email" value="<?php echo $user_email; ?>">
            <label for="pwd">Ditt gammel passord</label>
            <input type="password" name="oldpwd" placeholder="Gammel Passord">
            <label for="pwd">Nytt passord</label>
            <input type="password" name="pwd" placeholder="Passord">
            <label for="pwdrepeat">Gjenta passord</label>
            <input type="password" name="pwdrepeat" placeholder="Gjenta Passord">
            <label for="notif">Varslinger</label>
            <input type="hidden" name="notif" value="0">
            <input type="checkbox" name="notif" value="1" checked>
            <button type="submit" name="submit">Lagre</button>
        </form>
    </div>
    <?php
    // Error messages
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fyll ut alle feltene!</p>";
        } else if ($_GET["error"] == "invalidemail") {
            echo "<p>Skriv in riktig email!</p>";
        } else if ($_GET["error"] == "passwordsdontmatch") {
            echo "<p>Din ny passord matcher ikke!</p>";
        } else if ($_GET["error"] == "stmtfailed") {
            echo "<p>Noe gikk galt!</p>";
        } else if ($_GET["error"] == "emailtaken") {
            echo "<p>Email er allerede registrert!</p>";
        }
    }
    ?>
</section>

<?php
include_once 'footer.php';
?>