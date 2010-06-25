<?php
$php_self = $_SERVER['PHP_SELF'];

if($logged_in) {
	if($is_mitarbeiter) {
		$output .= get_link("Meine Anfragen", $php_self.'?site=supporter_anfragen').' | ';
		$output .= get_link("Supportteam Anfragen", $php_self.'?site=supportart_anfragen').' | ';
		$output .= get_link("Suchen", $php_self.'?site=suchen').' | ';
	} else {
		$output .= get_link("Anfrage erstellen", $php_self.'?site=anfrage_erstellen').' | ';
		$output .= get_link("Meine Anfragen", $php_self.'?site=user_anfragen').' | ';
	}
	$output .= get_link("Eingeloggt als <i>".($is_mitarbeiter ? "Supporter" : "Kunde")."</i> '<b>".$_SESSION['user_name']."</b>'", $php_self.'?site=einstellungen');
	$output .= ' | '.get_link("Logout", $php_self.'?site=logout');
} else {
	$output .= get_link("Login", $php_self.'?site=login');
	$output .= ' | '.get_link("Registration", $php_self.'?site=registrieren');
}

function get_link($text, $url) {
	return '<a href="'.$url.'">'.$text.'</a>';
}
?>