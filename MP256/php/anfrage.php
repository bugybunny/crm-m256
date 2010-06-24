<?php
$anfrage_id = isset($g_id) ? trim($g_id) : "0";

$output .= '<h1></h1>';

$anfrage = get_anfrage($anfrage_id);
if(!empty($anfrage)) {
	$output .= "Datum: ".$anfrage['datum']."<br/>";
	$output .= "Betreff: ".$anfrage['betreff']."<br/>";
	$output .= "Problem: ".$anfrage['problem']."<br/>";
	$output .= "Vorname: ".$anfrage['vorname']."<br/>";
	$output .= "Name: ".$anfrage['name']."<br/>";
	$output .= "Email: ".$anfrage['email']."<br/>";
	$output .= "Status: ".$anfrage['status']."<br/>";
} else {
	$output .= "Keine Anfrage mit Id $anfrage_id gefunden.";
}
?>