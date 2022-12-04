<?php
include_once 'includes/functions.inc.php';
include_once 'header.php';
if (!isset($_SESSION["userid"])) {
    header("location: login.php");
}
?>







<?php

include_once 'footer.php';
