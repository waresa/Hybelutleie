<?php
include 'header.php';
include 'includes/dbh.inc.php';

//if user is not logged in, ask them to log in
if (!isset($_SESSION['userid'])) {
    header("Location:login.php");
}
?>



<div class="content">
    <div class="container">


        <section id="message">

            <div class="message-sent2" id="messagebody">
                <!-- get the message sender name from url and display it -->
                <div id="sendername"><?php echo $_GET['from']; ?></div>
                <hr style="width: 99%;">

                <?php
                //get the ad title and display it
                $ad_id = $_GET['ad_id'];
                $ad = getAd($conn, $ad_id);
                $adt = $ad['title'];
                echo "
                <a href= 'productpage.php?ad_id=$ad_id'>
                <div id='adtitle'>$adt</div>
                </a>
                ";

                ?>
                <hr style="width: 99%;">


                <?php
                //get the messages from the database and display them
                $username = $_SESSION['username'];
                $uid = $_SESSION['userid'];

                //check if there is a message between the user and the sender in the database
                $from = $_GET['from'];
                $isInbox = isUserInInbox($conn, $uid, $from, $ad_id);

                //if there is no message, redirect to inbox
                if (!$isInbox) {
                    header("location: inbox.php?error=feil");
                }
                $sender = $_GET['from'];
                $sql = "SELECT message, created, sender FROM messages WHERE receiver = ? AND sender = ? AND ad_id = ? OR receiver = ? AND sender = ? and ad_id = ? ORDER BY created ASC";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: index.php?error=noegikkgalt");
                } else {
                    mysqli_stmt_bind_param($stmt, "ssssss", $username, $sender, $ad_id, $sender, $username, $ad_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                        <div class='msg'>                    
                        <div class='product'>
                            <div class='msg-name2'> <span class = 'messagerow'>
                            " . "
                                <span class='fra2'> " . $row['sender'] . ": </span> 
                                " . $row['message'] . " 
                                <span id='datemsg'>" . $row['created'] .  "</span>
                            </span></div>
                        </div> 
                        </div>";
                        }
                    }
                }

                ?>

                <hr style="border-top: 1px;">
            </div>

            <!-- Message form -->
            <div class="message-form-form">
                <form action="includes/sendmsg.inc.php" method="post">
                    <label for="msg">Skriv:</label>
                    <textarea name="message" id="msg" cols="40" rows="1"></textarea>
                    <input type="text" name="toid" id="" value="<?php echo $sender; ?>" style="display: none;">
                    <button type="submit" class="snd" name="submit">Send</button>
                    <input type="text" name="adid" value="<?php echo $ad_id ?>" style="display:none;">
                </form>
            </div>


        </section>

    </div>
</div>


<?php
include 'footer.php';
?>