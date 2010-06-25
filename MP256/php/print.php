<?php
$array = unserialize($_POST['anfragen']);

$output = "<?xml version='1.0' encoding='ISO-8859-1' ?>\n";
$output .= "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'
          'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>\n";
$output .= "<html xmlns='http://www.w3.org/1999/xhtml' lang='de' xml:lang='de'>\n";
$output .= "<head>\n";
$output .= "<title>Anfragen-Auswertung drucken</title>\n";
$output .= "<link rel='stylesheet' type='text/css' href='../media/print.css' />\n";
$output .= "</head>\n";
$output .= "<body onload='javascript:window.print(self)'>\n";
$output .= "<h1>Auswertung</h1>";
$output .= createTable($array);
$output .= "</body>";
$output .= "</html>";
echo $output;

// TODO richtig formatieren
function createTable($array) {
	if(count($array) == 0){
		return "Keine Daten vorhanden!";
	}
	$return = "<table id=\"tabelle\" cellpadding=\"0\" cellspacing=\"0\" width=\"960px\">";
	$return .= "<tr align=\"left\">";
	$return .= "<th width='80px'>Datum</th>";
	$return .= "<th width='150px'>Betreff</th>";
	$return .= "<th width='160px'>Kunde</th>";
	$return .= "<th width='160px'>Supporter</th>";
	$return .= "<th width='160px'>Supportart</th>";
	$return .= "<th width='80px'>Status</th></tr>";
	
	foreach($array as $anfrage) {
		$return .= "<tr>";
		$return .= "<td>".$anfrage['datum']."</td>";
		$return .= "<td>".$anfrage['betreff']."</td>";
		$return .= "<td>".$anfrage['kunde']."</td>";
		$return .= "<td>".$anfrage['supporter']."</td>";
		$return .= "<td>".$anfrage['supportart']."</td>";
		$return .= "<td>".$anfrage['status']."</td></tr>";
	}
	
	/*for ($i = 0; $i < count($array); $i++){
//		Datum, Betreff, Kunde, Supporter, Supportart, Status
		$return .= "<tr>";
		$return .= "<td>".$array[$i]['datum']."</td>";
		$return .= "<td>".$array[$i]['betreff']."</td>";
		$return .= "<td>".$array[$i]['kunde']."</td>";
		$return .= "<td>".$array[$i]['supporter']."</td>";
		$return .= "<td>".$array[$i]['supportart']."</td>";
		$return .= "<td>".$array[$i]['status']."</td></tr>";
	}*/
	$return .= "</table>";
	return $return;
}
?>