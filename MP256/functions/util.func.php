<?php
function convert_date($date, $format){
	$stamp = strtotime($date);
	$newDate = date($format, $stamp);
	return $newDate;
}

function uml_replace($string){
	$replace = array("ä" => "&auml;", "ü" => "&uuml;", "ö" => "&ouml;", "Ä" => "&Auml;", "Ü" => "&Uuml;", "Ö" => "&Ouml;"); 
	return strtr($string, $replace);
}
?>