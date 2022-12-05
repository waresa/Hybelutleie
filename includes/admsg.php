<div class="block1">
    <?php
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