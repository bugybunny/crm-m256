<?php
// TODO entfernen
require_once '../functions/html.func.php';
require_once '../functions/database.func.php';
get_connection();

$anfragen = isset($_REQUEST['anfragen']) ? unserialize($_REQUEST['anfragen']) : null;

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
$output .= "<body onload='javascript:print_window(self)'>\n";
$output .= "<div id='pButtons'";
$output .= "&nbsp;»<a href='javascript:print_window(self)'>Drucken</a>";
$output .= "&nbsp;»&nbsp;<a href='javascript:window.close(self)'>Fenster schliessen</a>";
$output .= "</div>";
if($anfragen != null) {
	foreach($anfragen as $anfrage) {
		$output .= format_anfrage($anfrage);
	}
}
$output .= html_footer();

echo $output;

// TODO richtig formatieren
function format_anfrage($anfrage) {
	$return .= "<table>";
	$return .= "<tr>";
	$return .= "<td width='100px'><strong>Betreff</strong></td>";
	$return .= "<td><input type='text' value='$anfrage[betreff]' readonly /></td>";
	$return .= "</tr>";
	$return .= "<tr>";
	$return .= "<td width='100px'><strong>Datum</strong></td>";
	$return .= "<td><input type='text' value='$anfrage[datum]' readonly /></td>";
	$return .= "</tr>";
	$return .= "<tr>";
	$return .= "<td width='100px'><strong>Problem</strong></td>";
	$return .= "<td><textarea cols='50' rows='10' value='$anfrage[problem]' readonly></textarea></td>";
	$return .= "</tr>";
	$return .= "<tr>";
	$return .= "<td width='100px'><strong>Kunde</strong></td>";
	$return .= "<td><input type='text' value='$anfrage[kunde]' readonly /></td>";
	$return .= "</tr>";
	$return .= "<tr>";
	$return .= "<td width='100px'></td>";
	$return .= "<td><input type='text' value='$anfrage[email]' readonly /></td>";
	$return .= "</tr>";
	$return .= "<tr>";
	$return .= "<td width='100px'>Status</td>";
	$return .= "<td><input type='text' value='$anfrage[status]' readonly /></td>";
	$return .= "</tr>";	
	$return .= "</table>";
	return $return;
}
?>