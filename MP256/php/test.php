<?php
$output = "<?xml version='1.0' encoding='ISO-8859-1' ?>\n";
$output .= "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'
          'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>\n";
$output .= "<html xmlns='http://www.w3.org/1999/xhtml' lang='de' xml:lang='de'>\n";
$output .= "<head>\n";
$output .= "<title>Anfragen-Auswertung drucken</title>\n";
$output .= "<script type='text/javascript' src='test.js'></script>\n";
$output .= "</head>\n";
//$output .= "<body onload='javascript:window.print(self)'>\n";
$output .= "<body>";

//		Datum, Betreff, Kunde, Supporter, Supportart, Status
$array = array(
			array(
				"datum" => "12.05.2010", 
				"betreff" => "FUU", 
				"kunde" => "Alessio Romagnolo",
				"supporter" => "Alessandro Manoiero",
				"supportart" => "Reklamation", 
				"status" => "OPEN"),
			array(
				"datum" => "13.05.2010", 
				"betreff" => "FUU1", 
				"kunde" => "Alessio Romagnolo1",
				"supporter" => "Alessandro Manoiero1",
				"supportart" => "Reklamation", 
				"status" => "OPEN"),
			array(
				"datum" => "14.05.2010", 
				"betreff" => "FUU2", 
				"kunde" => "Alessio Romagnolo2",
				"supporter" => "Alessandro Manoiero2",
				"supportart" => "Reklamation", 
				"status" => "OPEN"),
			array(
				"datum" => "15.05.2010", 
				"betreff" => "FUU3", 
				"kunde" => "Alessio Romagnolo3",
				"supporter" => "Alessandro Manoiero3",
				"supportart" => "Reklamation", 
				"status" => "OPEN"),
			array(
				"datum" => "16.05.2010", 
				"betreff" => "FUU4", 
				"kunde" => "Alessio Romagnolo4",
				"supporter" => "Alessandro Manoiero4",
				"supportart" => "Reklamation", 
				"status" => "OPEN"),
			array(
				"datum" => "17.05.2010", 
				"betreff" => "FUU5", 
				"kunde" => "Alessio Romagnolo5",
				"supporter" => "Alessandro Manoiero5",
				"supportart" => "Technische Unterstuetzung", 
				"status" => "REWORKING"),
			array(
				"datum" => "18.05.2010", 
				"betreff" => "FUU6", 
				"kunde" => "Alessio Romagnolo6",
				"supporter" => "Alessandro Manoiero6",
				"supportart" => "Reklamation", 
				"status" => "WORKING"),
			);




$output .= "<input type=\"hidden\" id=\"array\" value='".serialize($array)."'/>";
$output .= "<input type=\"button\" onclick=\"print_list()\" value='PRINT'/>";
$output .= "</body>";
$output .= "</html>";

echo $output;
?>