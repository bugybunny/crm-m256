<?php
$php_self = $_SERVER['PHP_SELF'];
$output .= 
	get_link("Login", $php_self.'?site=login').
	' | '.
	get_link("Registration", $php_self.'?site=registrieren').
	' | '.
	get_link("Logout", $php_self.'?site=logout');

function get_link($text, $url) {
	return '<a href="'.$url.'">'.$text.'</a>';
}
?>