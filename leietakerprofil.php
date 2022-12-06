<!-- Page to create and update what to get notifications about -->

<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php';

//if user is not logged in, redirect to login page
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
}

//get user info
$user = getUser($conn, $_SESSION['userid']);

//get user notif setting
$user_notif = $user['notif'];
//get user leietaker profile
$profile = getRenter($conn, $_SESSION['userid']);

//if user has a profile, get the wants and budget to display in the form
if ($profile != NULL) {
    $wants = explode(", ", $profile['wants']);
    $budget = $profile['budget'];
} else {
    //if user does not have a profile, set wants and budget to empty
    $wants = [];
    $budget = "";
}

?>


<!-- form -->
<section class="signup-form" id="createad">
    <h2 class="hvdg">Min leietaker-profil</h2>
    <h3 style="text-align:center;">Lag en profil for å få varslinger om nye annonser som matcher med dine ønsker og budsjett.</h3>
    <hr>
    <div class="signup-form-form">
        <form action='includes/leietakerprofil.inc.php' method="post" enctype="multipart/form-data">
            <label for="budget">Budsjett</label>
            <input type="number" name="budget" placeholder="Budsjett" value=<?php echo $budget; ?>>
            <fieldset>
                <legend>Ønsket fasiliteter</legend>
                <label for="Møbler">Møbler</label>
                <input type="checkbox" name="fasiliteter[]" value="Møbler" <?php if (in_array("Møbler", $wants)) {
                                                                                echo "CHECKED";
                                                                            }  ?>>
                <label for="Hvitevarer">Hvitevarer</label>
                <input type="checkbox" name="fasiliteter[]" value="Hvitevarer" <?php if (in_array("Hvitevarer", $wants)) {
                                                                                    echo "CHECKED";
                                                                                }  ?>>
                <label for="Balkong">Balkong</label>
                <input type="checkbox" name="fasiliteter[]" value="Balkong" <?php if (in_array("Balkong", $wants)) {
                                                                                echo "CHECKED";
                                                                            }  ?>>
                <label for="Terrasse">Terrasse</label>
                <input type="checkbox" name="fasiliteter[]" value="Terrasse" <?php if (in_array("Terrasse", $wants)) {
                                                                                    echo "CHECKED";
                                                                                }  ?>>
                <label for="Parkering">Parkering</label>
                <input type="checkbox" name="fasiliteter[]" value="Parkering" <?php if (in_array("Parkering", $wants)) {
                                                                                    echo "CHECKED";
                                                                                }  ?>>
                <label for="Husdyr tillatt">Husdyr tillatt</label>
                <input type="checkbox" name="fasiliteter[]" value="Husdyr tillatt" <?php if (in_array("Husdyr tillatt", $wants)) {
                                                                                        echo "CHECKED";
                                                                                    }  ?>>
                <label for="Røyking tillatt">Røyking tillatt</label>
                <input type="checkbox" name="fasiliteter[]" value="Røyking tillatt" <?php if (in_array("Røyking tillatt", $wants)) {
                                                                                        echo "CHECKED";
                                                                                    }  ?>>
                <input type="hidden" name="fasiliteter[]" value=" ">
            </fieldset>
            <label for="notif">Motta varslinger</label>
            <input type="checkbox" name="notif" value="1" <?php if ($user_notif == 1) {
                                                                echo 'CHECKED';
                                                            } ?>>

            <button type="submit" name="submit">Lagre</button>
        </form>
    </div>
</section>

<?php
include_once 'footer.php';
?>