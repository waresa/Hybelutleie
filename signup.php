<?php
include_once 'header.php';
?>

<section class="signup-form">
  <h2>Registrer deg selv</h2>
  <div class="signup-form-form">
    <form action="includes/signup.inc.php" method="post">
      <input type="text" name="name" placeholder="Fult Navn">
      <input type="text" name="email" placeholder="Email">
      <input type="password" name="pwd" placeholder="Passord">
      <input type="password" name="pwdrepeat" placeholder="Gjenta Passord">
      <button type="submit" name="submit">Sign up</button>
    </form>
  </div>
  <?php
  // Error messages
  if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
      echo "<p>Fyll ut alle feltene!</p>";
    } else if ($_GET["error"] == "invalidemail") {
      echo "<p>Skriv in riktig email!</p>";
    } else if ($_GET["error"] == "passwordsdontmatch") {
      echo "<p>Passord matcher ikke!</p>";
    } else if ($_GET["error"] == "stmtfailed") {
      echo "<p>Noe gikk galt!</p>";
    } else if ($_GET["error"] == "emailtaken") {
      echo "<p>Email er allerede registrert!</p>";
    } else if ($_GET["error"] == "none") {
      echo "<p>Du er noe registrert!</p>";
    }
  }
  ?>
</section>

<?php
include_once 'footer.php';
?>