<?php
// Benötigte Dateien einbinden
require_once 'functions/check.func.php';
require_once 'functions/ajax.func.php';
require_once 'functions/html.func.php';
require_once 'functions/database.func.php';
require_once 'functions/validation.func.php';

// Session starten
session_start();

// Extrahieren der POST & GET Variablen
extract($_GET, EXTR_PREFIX_ALL, "g");
extract($_POST, EXTR_PREFIX_ALL, "p");

// Allgemein benötigte Variablen deklarieren
$php_self = $_SERVER['PHP_SELF'];
$home_path = get_home_path($php_self);
$home = "startseite";
$site = isset($g_site) && !empty($g_site) ? $g_site : $home;

// Session Variablen abfüllen
$logged_in = isset($_SESSION["logged_in"]) && $_SESSION["logged_in"];

$title = "CRM Applikation";
$output = "";

// Datenbankverbindung aufbauen
$connection = get_connection();

// Anzeigen des HTML-Header
$output .= html_header($title);

// Anzeigen des Content-Bereiches (einbinden der Seite)
$output .= 
'<div align="center">
	<div id="content">
		<a href="'.$php_self.'"><div id="logo"></div></a>
		<div id="navigation">';
			include 'php/module/navigation.php';
			$output .= 
		'</div>
			<div id="text">
				<div id="site">';
					if(is_file('php/'.$site.'.php')){
						include('php/'.$site.'.php');
					} else {
						include('php/error.php');
					}
			$output .= 
			'</div>
		</div>
	</div>
</div>
<input type="hidden" id="home_url" value="'.$home_path.'" />
<input type="hidden" id="user_id" value="'.$_SESSION['user_id'].'" />';

// Anzeigen des HTML-Footer
$output .= html_footer();

// Datenbank-Connection schliessen
mysql_close($connection);

// Ausgabe des Codes
echo $output;
?>