<?php
function convert_date($date, $format){
	$stamp = strtotime($date);
	$newDate = date($format, $stamp);
	return $newDate;
}
?>