<?php

//destroy the session, and redirect to index.php
session_start();
session_unset();
session_destroy();

header("location: index.php");
exit();
