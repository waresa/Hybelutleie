<?php
include 'header.php';
include 'includes/dbh.inc.php';

?>




<div class="content">
    <div class="container">

        <section id="message">

            <div class="message-sent2">
                <p style="text-align: center ;">Meldinger</p>
                <?php

                require 'includes/inbox.inc.php';

                ?>
            </div>

        </section>
    </div>
</div>


<?php
include 'footer.php';
?>