<!--Splitting the header and footer into separate documents makes things easier!-->
<?php
include_once 'header.php';
if (!isset($_SESSION['userid'])) {
  header("Location:login.php");
}
?>

<section class="index-categories">
  <h2>Categories</h2>
  <div class="index-categories-list">
    <div>
      <h3>Category 1</h3>
    </div>
    <div>
      <h3>Category 2</h3>
    </div>
    <div>
      <h3>Category 3</h3>
    </div>
    <div>
      <h3>Category 4</h3>
    </div>
  </div>
</section>

<?php
include_once 'footer.php';
?>