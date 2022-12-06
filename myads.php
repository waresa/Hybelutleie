<?php
include 'header.php';
include 'includes/dbh.inc.php';

//if user is not logged in, redirect them to login page
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
}

//if user is logged in, set the user id
$user_id = $_SESSION['userid'];
?>

<div class="content">
    <div class="container">
        <?php
        //get all ads from the user and show them
        $ad = getUserAd($conn, $user_id);
        $i = 0;
        while ($i < count($ad)) {
            $ad_id = $ad[$i][0];
            $img = getFirstImgOfAd($conn, $ad_id);
            $imgname = $img['file_name'];
            $imgpath = "includes/img/" . $imgname;
            echo "
            <a class='products' href= 'productpage.php?ad_id=$ad_id'>
			<img src='" . $imgpath . " '>
            <div class='product'>
            <div class='productname'>" . $ad[$i][1] . "</div>
            <div class='productaddress'>" . $ad[$i][11] . '<br>' . $ad[$i][12] . ' ,' . $ad[$i][13] . "</div>
            <div class='productprice'>" . $ad[$i][2] . " kr -";
            if ($ad[$i][15] == 1) {
                echo "
                <div class='producprice'>-- Status: Slettet</div></div></div></a>";
            } else {
                echo "</div></div></a>";
            }
            $i++;
        }

        ?>

    </div>
</div>


<?php
include 'footer.php';
?>