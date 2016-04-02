<?php
session_start();

session_unset();
session_destroy();
header("location: LOGIN2.php");
exit;
?>