<?php
include_once 'header.php';
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
}
?>

<section class="signup-form" id="createad">
    <h2 class="hvdg">Ny leietaker-profil</h2>
    <div class="signup-form-form">
        <form action="includes/createrenter.inc.php" method="post" enctype="multipart/form-data">
            <label for="budget">Budsjett</label>
            <input type="number" name="budget" placeholder="Budsjett">
            <fieldset>
                <legend>Ønsket fasiliteter</legend>
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
                <input type="hidden" name="fasiliteter[]" value=" ">
            </fieldset>

            <button type="submit" name="submit">Legg ut</button>
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