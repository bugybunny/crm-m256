<?php
// Benötigte Dateien einbinden
require_once 'functions/check.func.php';
require_once 'functions/ajax.func.php';
require_once 'functions/html.func.php';

// Session starten
session_start();

// Extrahieren der POST & GET Variablen
extract($_GET, EXTR_PREFIX_ALL, "g");
extract($_POST, EXTR_PREFIX_ALL, "p");

// Allgemein benötigte Variablen deklarieren
$home = "startseite";
$site = isset($g_site) && !empty($g_site) ? $g_site : $home;

// Session Variablen abfüllen
$logged_in = isset($_SESSION["logged_in"]) && $_SESSION["logged_in"];

$title = "CRM Applikation";
$output = "";

// Datenbankverbindung aufbauen
// $connection = getConnection();

// Anzeigen des HTML-Header
$output .= html_header($title);

// Anzeigen des Content-Bereiches (einbinden der Seite)
$output .= 
'<div align="center">
	<div id="content">
		<div id="logo"></div>
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
</div>';

// Anzeigen des HTML-Footer
$output .= html_footer();

// Datenbank-Connection schliessen
// mysql_close($connection);

// Ausgabe des Codes
echo $output;
?>