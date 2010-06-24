<?php
function convert_date($date, $format){
	$stamp = strtotime($date);
	$newDate = date($format, $stamp);
	return $newDate;
}

function uml_replace($string){
	$replace = array("�" => "&auml;", "�" => "&uuml;", "�" => "&ouml;", "�" => "&Auml;", "�" => "&Uuml;", "�" => "&Ouml;"); 
	return strtr($string, $replace);
}
?>