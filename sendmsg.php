<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php';

//if user is not logged in, redirect to login page
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
}

//get to id from url and set the user as uid
$to_idtmp = $_GET['to_id'];
$uid = $_SESSION['userid'];

//get user name of the message receiver
$un = getUser($conn, $to_idtmp);
$to_name = $un['usersName'];

//get ad id from url
$ad_id = $_GET['ad_id'];

//if the ad is not by the user, or the ad id and to id is not set, redirect to index
if (!isset($_GET['to_id']) || !isset($ad_id) || !isAdByUser($conn, $ad_id, $to_idtmp)) {
    header("Location: index.php");
}
?>

<section class="signup-form" id="msgform">
    <div class="block1">
        <?php
        //get ad info and show it in the message form
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

    <!-- message form -->
    <div class="block2" id="msgb2">
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
</section>

<?php
include_once 'footer.php';
?>