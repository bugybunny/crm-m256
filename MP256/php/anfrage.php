<?php
check_login();

$anfrage_id = isset($g_id) ? trim($g_id) : "0";

$anfrage = get_anfrage($anfrage_id);
if(!empty($anfrage)) {
	$output .= '<h1>'.$anfrage['betreff'].'</h1>';
	$output .=
	'<table width="940px">
		<tr>
			<td class="left" width="110px">Datum:</td>
			<td>'.convert_date($anfrage['datum'], "d.m.Y - H:i").'</td>
		</tr>
		<tr>
			<td class="left">Kunde:</td>
			<td>'.$anfrage['kunde'].'</td>
		</tr>
	</table>
	<br/>
	<table width="940px">
		<tr>
			<td class="left" width="110px">Status:</td>
			<td><b>'.$anfrage['status'].'</b></td>
		</tr>
		<tr>
			<td class="left">Supportart:</td>
			<td>'.$anfrage['supportart'].'</td>
		</tr>
		<tr valign="top">
			<td class="left">Problem:</td>
			<td colspan="2">'.nl2br($anfrage['problem']).'</td>
		</tr>
	</table>
	<h2>Antwort</h2>';
	$antwort = get_antwort($anfrage_id);
	if(!empty($antwort)) {
		$output .=
		'<table width="940px">
			<tr>
				<td class="left" width="110px">Datum:</td>
				<td>'.convert_date($antwort['datum'], "d.m.Y - H:i").'</td>
			</tr>
			<tr>
				<td class="left">Supporter:</td>
				<td>'.$antwort['supporter'].'</td>
			</tr>
			<tr>
				<td class="left" valign="top">Antwort:</td>
				<td>'.nl2br($antwort['antwort']).'</td>
			</tr>
		</table>';
	} else {
		if(is_anfrage_supporter($_SESSION["user_id"], $anfrage_id))
			$output .= '<u><a href="'.$php_self.'?site=antwort_erstellen&id='.$anfrage_id.'">Antworten</a></u>';
		else
			$output .= 'Es ist noch keine Antwort vorhanden';
	}
} else {
	$output .= "<h1>Anfrage</h1>";
	$output .= "Keine Anfrage mit der Anfrage-Id $anfrage_id gefunden.";
}
?>