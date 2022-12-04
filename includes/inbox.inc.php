<?php
$user_id = $_SESSION['userid'];
$username = $_SESSION['username'];

$inx = getUsersInbox($conn, $user_id);
if ($inx !== false) {

    $i = 0;
    while ($i < count($inx)) {
        $sender = $inx[$i][1];
        $ad_id = $inx[$i][2];
        $ad = getAd($conn, $ad_id);
        $adt = $ad['title'];
        $ad_title = substr($adt, 0, 50);

        echo "
    <a class='msg' id='msg' href= 'msgs.php?from=$sender&ad_id=$ad_id'>

    <div class='msg-name'><span class = 'messagerow' ><span class = 'fra'> $sender</span><span style = 'float: right;'>$ad_title...</span></span></div></a>";
        $i++;
    }
} else {
    echo "<p style = 'text-align: center;' class='msg'>Du har ingen meldinger</p>";
}
