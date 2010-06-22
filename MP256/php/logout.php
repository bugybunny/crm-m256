<?php
unset($_SESSION["logged_in"]);
header("Location: ".$_SERVER['PHP_SELF']);
?>