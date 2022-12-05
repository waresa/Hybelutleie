<?php
include_once 'header.php';
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
}
?>

<section class="signup-form" id="createad">
    <h2 class="hvdg">Lag ny annonse</h2>
    <div class="signup-form-form">
        <form action="includes/createad.inc.php" method="post" enctype="multipart/form-data">
            <label for="upl">Last opp bilder for annonsen: </label>
            <input type="file" name="upload[]" id="upl" accept="image/*" multiple required>
            <label for="title">Tittel</label>
            <input type="text" name="title" placeholder="Tittel" required>
            <label for="leie">Månedsleie</label>
            <input type="text" name="leie" placeholder="Månedsleie">
            <label for="depositum">Depositum</label>
            <input type="text" name="depositum" placeholder="Depositum">
            <label for="boligtype">Boligtype</label>
            <select name="boligtype" id="boligtype">
                <option value="Hybel">Hybel</option>
                <option value="Leilighet">Leilighet</option>
                <option value="Enebolig">Enebolig</option>
                <option value="Rekkehus">Rekkehus</option>
            </select>
            <label for="antallrom">Antall Soverom</label>
            <input type="number" name="antallrom" placeholder="Antall Soverom">
            <label for="areal">Areal</label>
            <input type="number" name="areal" placeholder="Areal">
            <label for="etasje">Etasje</label>
            <input type="number" name="etasje" placeholder="Etasje">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" placeholder="Adresse">
            <label for="postnr">Postnummer</label>
            <input type="text" name="postnr" placeholder="Postnummer">
            <label for="poststed">Poststed</label>
            <input type="text" name="poststed" placeholder="Poststed">
            <label for="leieperiode">Leiepeiode</label>
            <select name="leieperiode" id="leieperiode">
                <option value="langtidsleie">Langtidsleie</option>
                <option value="korttidsleie">Korttidsleie</option>
            </select>
            <label for="ledigfra">Ledig fra</label>
            <input type="date" name="ledigfra" placeholder="Ledig fra: ">
            <fieldset>
                <legend>Fasiliteter</legend>
                <label for="Møbler">Møbler</label>
                <input type="checkbox" name="fasiliteter[]" value="Møbler">
                <label for="Hvitevarer">Hvitevarer</label>
                <input type="checkbox" name="fasiliteter[]" value="Hvitevarer">
                <label for="Balkong">Balkong</label>
                <input type="checkbox" name="fasiliteter[]" value="Balkong">
                <label for="Terrasse">Terrasse</label>
                <input type="checkbox" name="fasiliteter[]" value="Terrasse">
                <label for="Parkering">Parkering</label>
                <input type="checkbox" name="fasiliteter[]" value="Parkering">
                <label for="Husdyr tillatt">Husdyr tillatt</label>
                <input type="checkbox" name="fasiliteter[]" value="Husdyr tillatt">
                <label for="Røyking tillatt">Røyking tillatt</label>
                <input type="checkbox" name="fasiliteter[]" value="Røyking tillatt">
                <input type="hidden" name="fasiliteter[]" value="Ikke oppitt">

            </fieldset>
            <label for="info">Om boligen: </label>
            <textarea name="info" id="info" cols="33" rows="10"></textarea>
            <button type="submit" name="submit">Lag</button>
        </form>
    </div>
    <?php
    // Error messages
    // if (isset($_GET["error"])) {
    //     if ($_GET["error"] == "emptyinput") {
    //         echo "<p>Fyll ut alle feltene!</p>";
    //     } else if ($_GET["error"] == "invalidemail") {
    //         echo "<p>Skriv in riktig email!</p>";
    //     } else if ($_GET["error"] == "passwordsdontmatch") {
    //         echo "<p>Passord matcher ikke!</p>";
    //     } else if ($_GET["error"] == "stmtfailed") {
    //         echo "<p>Noe gikk galt!</p>";
    //     } else if ($_GET["error"] == "emailtaken") {
    //         echo "<p>Email er allerede registrert!</p>";
    //     } else if ($_GET["error"] == "none") {
    //         echo "<p>Du er noe registrert!</p>";
    //     }
    // }
    // 
    ?>
</section>

<?php
include_once 'footer.php';
?>