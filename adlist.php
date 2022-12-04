<?php
include 'header.php';
include 'includes/dbh.inc.php';

?>


<div class="search">
    <label>
        <form action="adlist.php" method="post">
            <input type="text" id="search" name="search" placeholder="Søk etter produkt..">
            <input type="submit" class="submit" value="Søk">
        </form>
    </label>
</div>
<div class="content">
    <div class="container">
        <?php
        if (isset($_POST['search'])) {
            require 'includes/searchads.inc.php';
        } else {
            require 'includes/allads.inc.php';
        }
        ?>

    </div>
</div>


<?php
include 'footer.php';
?>