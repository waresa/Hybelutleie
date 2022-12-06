<!-- The create ad page -->

<?php
include_once 'header.php';

//if user is not logged in, redirect to login page
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
}
?>

<section class="signup-form" id="createad">
    <!-- Header -->
    <h2 class="hvdg">Lag ny annonse</h2>

    <!-- Form -->
    <div class="signup-form-form">
        <form action="includes/createad.inc.php" method="post" enctype="multipart/form-data">
            <label for="upl">Last opp bilder for annonsen: </label>
            <input type="file" name="upload[]" id="upl" accept="image/*" multiple required>
            <label for="title">Tittel</label>
            <input type="text" name="title" placeholder="Tittel" required>
            <label for="leie">Månedsleie</label>
            <input type="number" name="leie" placeholder="Månedsleie" required>
            <label for="depositum">Depositum</label>
            <input type="number" name="depositum" placeholder="Depositum" required>
            <label for="boligtype">Boligtype</label>
            <select name="boligtype" id="boligtype">
                <option value=""> </option>
                <option value="Hybel">Hybel</option>
                <option value="Leilighet">Leilighet</option>
                <option value="Enebolig">Enebolig</option>
                <option value="Rekkehus">Rekkehus</option>
            </select>
            <label for="antallrom">Antall Soverom</label>
            <input type="number" name="antallrom" placeholder="Antall Soverom" required>
            <label for="areal">Areal</label>
            <input type="number" name="areal" placeholder="Areal" required>
            <label for="etasje">Etasje</label>
            <input type="number" name="etasje" placeholder="Etasje">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" placeholder="Adresse" required>
            <label for="postnr">Postnummer</label>
            <input type="text" name="postnr" placeholder="Postnummer" required>
            <label for="poststed">Poststed</label>
            <input type="text" name="poststed" placeholder="Poststed" required>
            <label for="leieperiode">Leiepeiode</label>
            <select name="leieperiode" id="leieperiode">
                <option value="langtidsleie">Langtidsleie</option>
                <option value="korttidsleie">Korttidsleie</option>
            </select>
            <label for="ledigfra">Ledig fra</label>
            <input type="date" name="ledigfra" placeholder="Ledig fra: " required>
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
                <input type="hidden" name="fasiliteter[]" value="">

            </fieldset>
            <label for="info">Om boligen: </label>
            <textarea name="info" id="info" cols="33" rows="10"></textarea>
            <button type="submit" name="submit">Lag</button>
        </form>
    </div>
</section>

<?php
include_once 'footer.php';
?>