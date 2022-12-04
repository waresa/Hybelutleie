
<?php
$sql = "SELECT * FROM ad order by ad_id desc";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

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
            <div class='productaddress'>" . $row['adresse'] . '<br>' . $row['postnr'] . ', ' . $row['poststed'] . "</div>
            <div class='productprice'>" . $row['leie'] . " kr" . "</div>" . "</div>" . "</a>";
    }
}
