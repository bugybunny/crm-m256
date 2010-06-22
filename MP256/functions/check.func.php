<?php
function check_login() {
	if(!$_SESSION["logged_in"]){
		header("Location: ".$_SERVER['PHP_SELF']."?site=login");
	}
}
?>