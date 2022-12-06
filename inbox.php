<?php
include 'header.php';
include 'includes/dbh.inc.php';



?>
<div class="content">
    <div class="container">

        <section id="message">

            <div class="message-sent2">
                <h2 class="hvdg">Meldinger</h2>
                <?php
                //if user is not logged in, ask them to log in
                if (!isset($_SESSION['userid'])) {
                    echo "<p style = 'text-align: center;' class='msg'>Logg in for å se dine meldinger!</p> <button class='btn btn-primary' style='margin-left: 25%;'><a href='login.php'>Logg inn</a></button>";
                } else {
                    //otherwise, show the user's inbox
                    require 'includes/inbox.inc.php';
                }


                ?>
            </div>

        </section>
    </div>
</div>


<?php
include 'footer.php';
?>