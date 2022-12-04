<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php';

$to_idtmp = $_GET['to_id'];
$uid = $_SESSION['userid'];

$un = getUser($conn, $to_idtmp);
$to_name = $un['usersName'];
$ad_id = $_GET['ad_id'];
?>

<section class="signup-form" id="msgform">
    <div class="block1">
        <?php
        $imgpath = getFirstImgOfAd($conn, $ad_id);
        $row = getAdInfo($conn, $ad_id);
        echo " 
        <div class='thumb-box'>
        <img src='includes/img/" . $imgpath['file_name'] . "'></div>
        <div class='content'> 
        <div class='container'>
        <div class='product'>
        <div class='productname'>" . $row['title'] . "</div>
        <div class='productaddress'>" . $row['adresse'] . '<br>' . $row['postnr'] . ' ,' . $row['poststed'] . "</div>
        <div class='productprice'>" . $row['leie'] . " kr" . "</div>" . "</div>" . "</a>";
        ?>
    </div>
    <div class="block2">
        <div class="signup-form-form">
            <form action="includes/sendmsg.inc.php" method="post">
                <label for="msg">Meldingen:</label>
                <textarea name="message" id="msg" cols="70" rows="10" required></textarea>
                <input type="text" name="toid" id="" value="<?php echo $to_name; ?>" style="display: none;">
                <input type="text" name="adid" id="" value="<?php echo $ad_id; ?>" style="display: none;">

                <button type="submit" name="submit">Send</button>
            </form>
        </div>
    </div>
    <?php
    // Error messages
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fyll ut alle feltene!</p>";
        } else if ($_GET["error"] == "invalidemail") {
            echo "<p>Skriv in riktig email!</p>";
        } else if ($_GET["error"] == "passwordsdontmatch") {
            echo "<p>Passord matcher ikke!</p>";
        } else if ($_GET["error"] == "stmtfailed") {
            echo "<p>Noe gikk galt!</p>";
        } else if ($_GET["error"] == "emailtaken") {
            echo "<p>Email er allerede registrert!</p>";
        } else if ($_GET["error"] == "none") {
            echo "<p>Du er noe registrert!</p>";
        }
    }
    ?>
</section>

<?php
include_once 'footer.php';
?>