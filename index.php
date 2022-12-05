<!--Splitting the header and footer into separate documents makes things easier!-->
<?php
include_once 'header.php';

?>

<section class="index-categories" id="categories">
  <h2 class="hvdg">Hva vil du gjøre?</h2>
  <div class="index-categories-list">

    <div class="ctg">
      <a href="adlist.php">
        <button type="submit" name="submit">Annonser</button>
      </a>
    </div>

    <div class="ctg">
      <a href="myads.php">
        <h3>
          <button type="submit" name="submit">Mine Annonser</button>
        </h3>
      </a>
    </div>

    <div class="ctg">
      <a href="createad.php">
        <h3>
          <button type="submit" name="submit">Lag Annonse</button>
        </h3>
      </a>
    </div>

    <div class="ctg">
      <a href="createrenter.php">
        <h3>
          <button type="submit" name="submit">Leietaker Profil</button>
        </h3>
      </a>
    </div>
  </div>
</section>

<?php
include_once 'footer.php';
?>