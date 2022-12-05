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

                require 'includes/inbox.inc.php';

                ?>
            </div>

        </section>
    </div>
</div>


<?php
include 'footer.php';
?>