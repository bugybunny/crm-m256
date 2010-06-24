<?php
check_login();

$output .= "<h1>Startseite</h1>";
$output .= "Herzlich willkommen <b>".$_SESSION["user_name"]."</b>";
?>