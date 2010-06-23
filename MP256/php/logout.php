<?php
unset($_SESSION["logged_in"]);
unset($_SESSION["user_id"]);
unset($_SESSION["user_role"]);
unset($_SESSION["user_team"]);

header("Location: ".$_SERVER['PHP_SELF']);
?>