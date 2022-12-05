<?php
include_once 'header.php';
?>

<section class="signup-form">
  <h2 class="hvdg">Registrer deg selv</h2>
  <div class="signup-form-form">
    <form action="includes/signup.inc.php" method="post">
      <label for="name">Brukernavn</label>
      <input type="text" name="name" placeholder="Brukernavn">
      <label for="email">E-post</label>
      <input type="text" name="email" placeholder="Email">
      <label for="pwd">Passord</label>
      <input type="password" name="pwd" placeholder="Passord">
      <label for="pwd-repeat">Gjenta passord</label>
      <input type="password" name="pwdrepeat" placeholder="Gjenta Passord">
      <label for="notif">Varslinger</label>
      <input type="hidden" name="notif" value="0">
      <input type="checkbox" name="notif" value="1" checked>
      <button type="submit" name="submit">Lag konto</button>
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
      echo "<p>Du er nå registrert!</p>";
    }
  }
  ?>
</section>

<?php
include_once 'footer.php';
?>