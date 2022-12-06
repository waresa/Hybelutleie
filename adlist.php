<!-- Page with the list of ads -->

<?php
include_once 'includes\dbh.inc.php';
include 'header.php';

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
        // If the user has searched for something, show the search results instead of all ads
        if (isset($_POST['search'])) {
            require 'includes/searchads.inc.php';
        } else {
            // Show all ads
            require 'includes/allads.inc.php';
        }
        ?>

    </div>
</div>


<?php
include 'footer.php';
?>