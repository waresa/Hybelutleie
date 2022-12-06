<?php
include_once 'header.php';
?>

<section class="signup-form">
  <h2 class="hvdg">Logg Inn</h2>
  <div class="signup-form-form">
    <form action="includes/login.inc.php" method="post">
      <label for="email">E-post</label>
      <input type="email" name="email" placeholder="Email">
      <label for="pwd">Passord</label>
      <input type="password" name="pwd" placeholder="Passord">
      <button type="submit" name="submit">Logg inn</button>
    </form>
  </div>
  <?php
  // Error messages
  if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
      echo "<p>Fill in all fields!</p>";
    } else if ($_GET["error"] == "wronglogin") {
      echo "<p>Wrong login!</p>";
    }
  }
  ?>
</section>

<?php
include_once 'footer.php';
?>