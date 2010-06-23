<?php
check_login();

$output .= "<h1>Fuuuuu</h1>";

$output .= $_SESSION["user_id"]."<br/>";
$output .= $_SESSION["user_role"]."<br/>";
$output .= $_SESSION["user_team"]."<br/>";

?>