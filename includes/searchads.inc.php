
<?php
//script for searching ads

//get search input from form
$search = "%" . $_POST['search'] . "%";
$sql = "SELECT * FROM ad WHERE title LIKE ? ";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: allads.php?error=noegikkgalt");
} else {
    mysqli_stmt_bind_param($stmt, "s", $search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $resultCheck = mysqli_num_rows($result);
    //if there are ads with the search input print them
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $ad_id = $row['ad_id'];
            $img = getFirstImgOfAd($conn, $ad_id);
            $imgname = $img['file_name'];
            $imgpath = "includes/img/" . $imgname;
            echo "
            <a class='products' href= 'productpage.php?ad_id=$ad_id'>
            <img src='" . $imgpath . " '>
            <div class='product'>
            <div class='productname'>" . $row['title'] . "</div>
            <div class='productaddress'>" . $row['adresse'] . '<br>' . $row['postnr'] . ' ,' . $row['poststed'] . "</div>
            <div class='productprice'>" . $row['leie'] . " kr" . "</div>" . "</div>" . "</a>";
        }
    } else {
        //if there are no ads with the search input print this
        echo "
            <div id='ingent'> Ingen treff </div>
        ";
    }
}
