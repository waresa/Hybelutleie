<?php
include 'header.php';
include 'includes/dbh.inc.php';
$user_id = $_SESSION['userid'];
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
}
?>

<div class="content">
    <div class="container">
        <?php
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
            <div class='productprice'>" . $ad[$i][2] . " kr" . "</div>" . "</div>" . "</a>";
            $i++;
        }

        ?>

    </div>
</div>


<?php
include 'footer.php';
?>