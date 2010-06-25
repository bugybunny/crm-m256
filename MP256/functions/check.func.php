<?php
/**
 * Leitet auf die Loginseite weiter, falls der User nicht eingeloggt ist
 */
function check_login() {
	if(!$_SESSION["logged_in"])
		header("Location: ".$_SERVER['PHP_SELF']."?site=login");
}

/**
 * Leitet den Kunden auf die Startseite weiter, falls er �ber die URL eine
 * nur f�r Supporter sichtbare Seite �ffnen will
 */
function check_mitarbeiter() {
	GLOBAL $is_mitarbeiter, $home;
	if(!$is_mitarbeiter)
		header("Location: ".$_SERVER['PHP_SELF']."?site=$home");
}

/**
 * Leitet den Supporter auf die Startseite weiter, falls er �ber die URL eine
 * nur f�r Kunden sichtbare Seite �ffnen will
 */
function check_kunde() {
	GLOBAL $is_mitarbeiter, $home;
	if($is_mitarbeiter)
		header("Location: ".$_SERVER['PHP_SELF']."?site=$home");
}

/**
 * Liefert den Rootpfad der Applikation zur�ck
 * @param $php_self string Inhalt von $_SERVER['PHP_SELF']
 */
function get_home_path($php_self) {
	if(strpos($php_self, ".php") > 0) {
		return substr($php_self, 0, strlen($php_self)-strpos(strrev($php_self), "/"));
	}
}

function show_error($warning) {
	if(!empty($warning))
		return '<img src="media/images/nok.png" alt="" border="0" />';
	return '';
}
?>