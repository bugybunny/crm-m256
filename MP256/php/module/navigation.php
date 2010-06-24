<?php
$php_self = $_SERVER['PHP_SELF'];

if($logged_in) {
	if($is_mitarbeiter) {
		$output .= get_link("Meine Anfragen", $php_self.'?site=supporter_anfragen').' | ';
		$output .= get_link("Supportteam Anfragen", $php_self.'?site=supportart_anfragen').' | ';
	} else {
		$output .= get_link("Anfrage erstellen", $php_self.'?site=anfrage_erstellen').' | ';
		$output .= get_link("Meine Anfragen", $php_self.'?site=user_anfragen').' | ';
	}
	$output .= get_link("Suchen", $php_self.'?site=suchen');
	$output .= ' | '.get_link("Eingeloggt als '<b>".$_SESSION['user_name']."</b>'", $php_self.'?site=einstellungen');
	$output .= ' | '.get_link("Logout", $php_self.'?site=logout');
} else {
	$output .= get_link("Login", $php_self.'?site=login');
}

function get_link($text, $url) {
	return '<a href="'.$url.'">'.$text.'</a>';
}
?>