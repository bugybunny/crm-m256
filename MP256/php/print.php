<?php
// TODO entfernen
require_once '../functions/html.func.php';
require_once '../functions/database.func.php';
get_connection();

$p_anfrageid = isset($_REQUEST['anfrageid']) ? mysql_escape_string($_REQUEST['anfrageid']) : null;
$p_supporterid = isset($_REQUEST['supporterid']) ? mysql_escape_string($_REQUEST['supporterid']) : null;

$output = "<?xml version='1.0' encoding='ISO-8859-1' ?>\n";
$output .= "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'
          'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>\n";
$output .= "<html xmlns='http://www.w3.org/1999/xhtml' lang='de' xml:lang='de'>\n";
$output .= "<head>\n";
$output .= "<title>Anfragen-Auswertung drucken</title>\n";
$output .= "<style type='text/css'>
	  			@page { size:auto;
	  	      	margin-top:1.7cm;
	  	      	margin-bottom:1.4cm;
	  	      	margin-left:2cm;
	  	      	margin-right:2cm;
	      		}
			</style>\n";
$output .= "</head>\n";
//$output .= "<body onload='javascript:window.print(self)'>\n";
$output .= "<body>";
$output .= "&nbsp;»<a href='javascript:window.print(self)'>Drucken</a>";
$output .= "&nbsp;»&nbsp;<a href='javascript:window.close(self)'>Fenster schliessen</a>";
/* $output .= get_single_anfrage(1); // TODO Variable übergeben */
if($p_anfrageid != null && p_supporterid == null) {
	$output .= get_single_anfrage($p_anfrageid);
} else {
	$output .= get_supporter_anfrage($p_supporterid);
}
$output .= html_footer();

echo $output;

// TODO richtig formatieren
function format_anfrage($anfrage) {
	$name = $anfrage['vorname'] . " " . $anfrage['name'];
	
	$return .= "<table>";
	$return .= "<tr>";
	$return .= "<td width='100px'><strong>Betreff</strong></td>";
	$return .= "<td><input type='text' value='{$anfrage['betreff']}' readonly /></td>";
	$return .= "</tr>";
	$return .= "<tr>";
	$return .= "<td width='100px'><strong>Datum</strong></td>";
	$return .= "<td><input type='text' value='{$anfrage['datum']}' readonly /></td>";
	$return .= "</tr>";
	$return .= "<tr>";
	$return .= "<td width='100px'><strong>Problem</strong></td>";
	$return .= "<td><textarea cols='50' rows='10' value='{$anfrage['problem']}' readonly></textarea></td>";
	$return .= "</tr>";
	$return .= "<tr>";
	$return .= "<td width='100px'><strong>Kunde</strong></td>";
	$return .= "<td><input type='text' value='$name' readonly /></td>";
	$return .= "</tr>";
	$return .= "<tr>";
	$return .= "<td width='100px'></td>";
	$return .= "<td><input type='text' value='$anfrage[email]' readonly /></td>";
	$return .= "</tr>";
	$return .= "<tr>";
	$return .= "<td width='100px'>Status</td>";
	$return .= "<td><input type='text' value='{$anfrage[status]}' readonly /></td>";
	$return .= "</tr>";	
	$return .= "</table>";
	return $return;
}

function get_single_anfrage($anfrageid) {
	$return_html = "";
	// TODO Session ist noch nicht verfügbar
	$_SESSION['logged_in'] = true;
	if($_SESSION["logged_in"]) {
		$anfrage = get_anfrage($anfrageid);
		if($anfrage != null) {
			$return_html .= format_anfrage($anfrage);
		} 
	}
	return $return_html;
}

function get_supporter_anfrage($supporerid) {
	$return_html = "";
	$_SESSION['logged_in'] = true;
	if($_SESSION["logged_in"]) {
		$anfragen = get_anfragenliste_support($supporterid);
		foreach($anfragen as $anfrage) {
			$return_html .= format_anfrage($anfrage);
		}
	}
}
?>