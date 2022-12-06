<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php';

// If user is not logged in, redirect to login page
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
}

$user_id = $_SESSION['userid'];

$ad_id = $_GET['ad_id'];

if (!isMyAd($conn, $ad_id, $user_id)) {
    header("Location:productpage.php?ad_id=$ad_id");
}

$ad = getAd($conn, $ad_id);

?>

<section class="signup-form" id="createad">
    <h2>Rediger Annonse</h2>
    <div class="signup-form-form">
        <form action="includes/editad.inc.php" method="post" enctype="multipart/form-data">
            <label for="title">Tittel</label>
            <input type="text" name="title" placeholder="Tittel" required value="<?php echo $ad['title']; ?>">
            <label for="leie">Månedsleie</label>
            <input type="text" name="leie" placeholder="Månedsleie" required value="<?php echo $ad['leie']; ?>">
            <label for="depositum">Depositum</label>
            <input type="text" name="depositum" placeholder="Depositum" required value="<?php echo $ad['depositum']; ?>">
            <label for="boligtype">Boligtype</label>
            <select name="boligtype" id="boligtype">
                <option value=""> </option>
                <option value="Hybel">Hybel</option>
                <option value="Leilighet">Leilighet</option>
                <option value="Enebolig">Enebolig</option>
                <option value="Rekkehus">Rekkehus</option>
            </select>
            <label for="antallrom">Antall Soverom</label>
            <input type="number" name="antallrom" placeholder="Antall Soverom" required value="<?php echo $ad['rom']; ?>">
            <label for="areal">Areal</label>
            <input type="number" name="areal" placeholder="Areal" required value="<?php echo $ad['areal']; ?>">
            <label for="etasje">Etasje</label>
            <input type="number" name="etasje" placeholder="Etasje" value="<?php echo $ad['etasje']; ?>">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" placeholder="Adresse" required value="<?php echo $ad['adresse']; ?>">
            <label for="postnr">Postnummer</label>
            <input type="text" name="postnr" placeholder="Postnummer" required value="<?php echo $ad['postnr']; ?>">
            <label for="poststed">Poststed</label>
            <input type="text" name="poststed" placeholder="Poststed" required value="<?php echo $ad['poststed']; ?>">
            <label for="leieperiode">Leieperiode</label>
            <select name="leieperiode" id="leieperiode">
                <option value="langtidsleie">Langtidsleie</option>
                <option value="korttidsleie">Korttidsleie</option>
            </select>
            <label for="ledigfra">Ledig Fra</label>
            <input type="date" name="ledigfra" placeholder="Ledig fra: " required value="<?php echo $ad['ledigfra']; ?>">
            <label for="info">Om boligen: </label>
            <textarea name="info" id="info" cols="33" rows="10"><?php echo $ad['poststed']; ?></textarea>
            <input type="text" name="ad_id" value="<?php echo $ad_id; ?>" style="display: none;">
            <button type="submit" name="submit">Rediger</button>
        </form>
    </div>
</section>

<?php
include_once 'footer.php';
?>