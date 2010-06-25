<?php
/**
 * Leitet auf die Loginseite weiter, falls der User nicht eingeloggt ist
 */
function check_login() {
	if(!$_SESSION["logged_in"])
		header("Location: ".$_SERVER['PHP_SELF']."?site=login");
}

/**
 * Leitet den Kunden auf die Startseite weiter, falls er über die URL eine
 * nur für Supporter sichtbare Seite öffnen will
 */
function check_mitarbeiter() {
	GLOBAL $is_mitarbeiter, $home;
	if(!$is_mitarbeiter)
		header("Location: ".$_SERVER['PHP_SELF']."?site=$home");
}

/**
 * Leitet den Supporter auf die Startseite weiter, falls er über die URL eine
 * nur für Kunden sichtbare Seite öffnen will
 */
function check_kunde() {
	GLOBAL $is_mitarbeiter, $home;
	if($is_mitarbeiter)
		header("Location: ".$_SERVER['PHP_SELF']."?site=$home");
}

/**
 * Liefert den Rootpfad der Applikation zurück
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