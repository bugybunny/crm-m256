<?php
function check_login() {
	if(!$_SESSION["logged_in"])
		header("Location: ".$_SERVER['PHP_SELF']."?site=login");
}

function check_mitarbeiter() {
	GLOBAL $is_mitarbeiter, $home;
	if(!$is_mitarbeiter)
		header("Location: ".$_SERVER['PHP_SELF']."?site=$home");
}

function check_kunde() {
	GLOBAL $is_mitarbeiter, $home;
	if($is_mitarbeiter)
		header("Location: ".$_SERVER['PHP_SELF']."?site=$home");
}

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