<?php
function get_anfragen_liste() {
	// DB ANFRAGE F�R LISTE
	$result =
	'<table>
		<tr>
			<th>Nr.</th>
			<th>Bereich</th>
			<th>Titel</th>
			<th>Kunde</th>
		</tr>';
	// ABF�LLEN DER DATEN
	for($i = 0; $i < 10; $i++) {
		$result .=
		'<tr>
			<td>'.$i.'</td>
			<td>Bereich '.$i.'</td>
			<td>Titel '.$i.'</td>
			<td>Kunde '.$i.'</td>
		</tr>';
	}
	$result .= '</table>';
	return $result;
}
?>