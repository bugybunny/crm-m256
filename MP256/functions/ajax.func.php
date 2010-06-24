<?php
function get_anfragen_liste($mitarbeiter_id, $status_id = 1) {
	// DB ANFRAGE FÜR LISTE
	$result =
	'<table>
		<tr style="border-bottom: 2px solid black;">
			<th style="width:20px;">Nr.</th>';
	if($status_id != 1){
		$result .=
			'<th style="width:140px;">Supportart</th>
			<th style="width:170px;">Kunde</th>
			<th style="width:170px;">Supporter</th>';
	}	else {
		$result .=
			'<th style="width:210px;">Supportart</th>
			<th style="width:280px;">Kunde</th>';
	}
	$result .=
			'<th style="width:400px;">Betreff</th>
		</tr>';
	// ABFÜLLEN DER DATEN

	$anfragen = get_anfragenliste_supportteam($status_id, $mitarbeiter_id);

	for($i = 0; $i < count($anfragen); $i++){
		$result .=
		'<tr style="border-bottom: 1px solid black;">
			<td align="center"><a href="index.php?site=anfragen">'.($anfragen[$i]['anfrage']).'</a></td>
			<td>'.($anfragen[$i]['supportart']).'</td>
			<td>'.($anfragen[$i]['kunde']).'</td>';
		if($status_id != 1){
		$result .=
			'<td>'.($anfragen[$i]['supporter']).'</td>';
		}
		$result .=
			'<td>'.($anfragen[$i]['betreff']).'</td>';
			if($status_id == 1){
				$result .= '<td><a href="#"><img src="media/images/eye-arrow.png" onclick="update_list(1, '.($anfragen[$i]['anfrage']).')" border=0 alt=""></img></a></td>';
			}
		$result .=
		'</tr>';
	}
	
	$result .= '</table>';
	return $result;
}

function get_user_anfragen($user_id, $status_id = 1){
	// DB ANFRAGE FÜR LISTE
	$result =
	'<table>
		<tr style="border-bottom: 2px solid black;">
			<th style="width:20px;">Nr.</th>';
	if($status_id != 1){
		$result .=
			'<th style="width:210px;">Supportart</th>
			<th style="width:270px;">Supporter</th>';
	}	else {
		$result .=
			'<th style="width:290px;">Supportart</th>';
	}
	$result .=
			'<th style="width:600px;">Betreff</th>
		</tr>';
	// ABFÜLLEN DER DATEN

	$anfragen = get_anfragenliste_user($user_id, $status_id);

	for($i = 0; $i < count($anfragen); $i++){
		$result .=
		'<tr style="border-bottom: 1px solid black;">
			<td align="center"><a href="index.php?site=anfragen">'.($anfragen[$i]['anfrage_nr']).'</a></td>
			<td>'.($anfragen[$i]['supportart']).'</td>';
		if($status_id != 1){
		$result .=
			'<td>'.($anfragen[$i]['mitarbeiter']).'</td>';
		}
		$result .=
			'<td>'.($anfragen[$i]['betreff']).'</td>
		</tr>';
	}
	
	$result .= '</table>';
	return $result;
}
?>