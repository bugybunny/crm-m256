<?php
$php_self = $_SERVER['PHP_SELF'];
$output .= $logged_in ? get_link("Logout", $php_self.'?site=logout') : get_link("Login", $php_self.'?site=login');
$output .= ' | '.get_link("Registration", $php_self.'?site=registrieren');
$output .= ' | '.get_link("Anfrage erstellen", $php_self.'?site=anfrage_erstellen');

function get_link($text, $url) {
	return '<a href="'.$url.'">'.$text.'</a>';
}
?>