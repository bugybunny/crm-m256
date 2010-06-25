<?php
/**
 * Sucht alle Anfragen eines Mitarbeiters mit einem bestimmten Status
 * und gibt die Liste formatiert zur�ck
 * 
 * @param $mitarbeiter_id int MitarbeiterID (anfrage.mitarbeiter_ref)
 * @param $status_id int StatusID(status.status_id)
 * @return $result string HTML-Code um die Anfrageliste anzuzeigen
 */
function get_anfragen_liste($mitarbeiter_id, $status_id = 1) {
	// DB ANFRAGE F�R LISTE
	$result =
	'<table id="tabelle" cellpadding="0" cellspacing="0" width="960px">
		<tr>
			<th width="30px">Nr.</th>';
	if($status_id != 1){
		$result .=
			'<th width="200px">Supportart</th>
			<th>Kunde</th>
			<th>Supporter</th>';
	}	else {
		$result .=
			'<th width="200px">Supportart</th>
			<th>Kunde</th>';
	}
	$result .=
			'<th colspan="2">Betreff</th>
		</tr>';
	// ABF�LLEN DER DATEN

	$anfragen = get_anfragenliste_supportteam($status_id, $mitarbeiter_id);

	for($i = 0; $i < count($anfragen); $i++){
		$result .=
		'<tr>
			<td><a href="index.php?site=anfrage&id='.$anfragen[$i]['anfrage'].'">'.($anfragen[$i]['anfrage']).'</a></td>
			<td>'.($anfragen[$i]['supportart']).'</td>
			<td>'.($anfragen[$i]['kunde']).'</td>';
		if($status_id != 1){
		$result .=
			'<td>'.($anfragen[$i]['supporter']).'</td>';
		}
		$result .=
			'<td><a href="index.php?site=anfrage&id='.$anfragen[$i]['anfrage'].'">'.($anfragen[$i]['betreff']).'</a></td>';
			if($status_id == 1){
				$result .= '<td align="right"><a href="#"><img src="media/images/eye-arrow.png" onclick="update_list(1, '.($anfragen[$i]['anfrage']).')" border=0 alt="" /></a></td>';
			} elseif($status_id == 2) {
				$result .= '<td align="right" width="20px"><a href="index.php?site=anfrage&id='.$anfragen[$i]['anfrage'].'"><img src="media/images/working.png" border=0 alt="" /></a></td>';
			} elseif($status_id == 3) {
				$result .= '<td align="right" width="20px"><a href="index.php?site=anfrage&id='.$anfragen[$i]['anfrage'].'"><img src="media/images/done.png" border=0 alt="" /></a></td>';
			}
		$result .=
		'</tr>';
	}
	if(count($anfragen) == 0){
		$result = keine_anfragen_meldung();
	} else {
		$result .= '</table>';
	}
	return $result;
}

/**
 * Sucht alle Anfragen eines Kunden mit einem bestimmten Status
 * und gibt die Liste formatiert zur�ck
 * 
 * @param $mitarbeiter_id int MitarbeiterID (anfrage.kunden_ref)
 * @param $status_id int StatusID(status.status_id)
 * @return $result string HTML-Code um die Anfrageliste anzuzeigen
 */
function get_user_anfragen($user_id, $status_id = 1){
	// DB ANFRAGE F�R LISTE
	$result =
	'<table id="tabelle" cellpadding="0" cellspacing="0" width="960px">
		<tr>
			<th width="30px">Nr.</th>';
	if($status_id != 1){
		$result .=
			'<th width="200px">Supportart</th>
			<th>Supporter</th>';
	}	else {
		$result .=
			'<th width="200px">Supportart</th>';
	}
	$result .=
			'<th colspan="2">Betreff</th>
		</tr>';
	// ABF�LLEN DER DATEN

	$anfragen = get_anfragenliste_user($user_id, $status_id);

	for($i = 0; $i < count($anfragen); $i++){
		$result .=
		'<tr>
			<td><a href="index.php?site=anfrage&id='.$anfragen[$i]['anfrage_nr'].'">'.($anfragen[$i]['anfrage_nr']).'</a></td>
			<td>'.($anfragen[$i]['supportart']).'</td>';
		if($status_id != 1){
		$result .=
			'<td>'.($anfragen[$i]['mitarbeiter']).'</td>';
		}
		$result .= '<td><a href="index.php?site=anfrage&id='.$anfragen[$i]['anfrage_nr'].'">'.($anfragen[$i]['betreff']).'</a></td>';
		
		$image = $status_id == 1 ? "open.png" : ($status_id == 2 ? "working.png" : "done.png");
		$result .= '<td align="right" width="20px"><a href="index.php?site=anfrage&id='.$anfragen[$i]['anfrage_nr'].'"><img src="media/images/'.$image.'" border=0 alt="" /></a></td>';
		$result .= '</tr>';
	}
	if(count($anfragen) == 0){
		$result = keine_anfragen_meldung();
	} else {
		$result .= '</table>';
	}
	return $result;
}

/**
 * Sucht alle Anfragen einer Supportart mit einem bestimmten Status
 * und gibt die Liste formatiert zur�ck
 * 
 * @param $mitarbeiter_id int MitarbeiterID (anfrage.kunden_ref)
 * @param $status_id int StatusID(status.status_id)
 * @return $result string HTML-Code um die Anfrageliste anzuzeigen
 */
function get_supporter_anfragen($mitarbeiter_id, $status_id = 2){
	GLOBAL $php_self;
	// DB ANFRAGE F�R LISTE
	$result =
	'<table id="tabelle" cellpadding="0" cellspacing="0" width="960px">
		<tr>
			<th width="30px">Nr.</th>';
	if($status_id != 1){
		$result .=
			'<th width="200px">Supportart</th>
			<th>Kunde</th>';
	}	else {
		$result .= '<th width="200px">Supportart</th>';
	}
	$result .=
			'<th '.($status_id == 2 || $status_id == 3 ? "colspan=\"2\"" : "").'>Betreff</th>
		</tr>';
	// ABF�LLEN DER DATEN

	$anfragen = get_anfragenliste_support($mitarbeiter_id, $status_id);

	for($i = 0; $i < count($anfragen); $i++){
		$result .=
		'<tr>
			<td><a href="index.php?site=anfrage&id='.$anfragen[$i]['anfrage_nr'].'">'.($anfragen[$i]['anfrage_nr']).'</a></td>
			<td>'.($anfragen[$i]['supportart']).'</td>';
		if($status_id != 1){
		$result .=
			'<td>'.($anfragen[$i]['kunde']).'</td>';
		}
		$result .= '<td><a href="'.$php_self.'?site=anfrage&id='.$anfragen[$i]['anfrage_nr'].'">'.($anfragen[$i]['betreff']).'</a></td>';
		if($status_id == 2){
			$result .= '<td align="right" width="20px"><a href="'.$php_self.'?site=anfrage&id='.$anfragen[$i]['anfrage_nr'].'"><img src="media/images/reply.png" border=0 alt="" /></a></td>';
		} elseif($status_id == 3) {
			$result .= '<td align="right" width="20px"><a href="'.$php_self.'?site=anfrage&id='.$anfragen[$i]['anfrage_nr'].'"><img src="media/images/done.png" border=0 alt="" /></a></td>';
		}
		$result .= '</tr>';
	}
	if(count($anfragen) == 0){
		$result = keine_anfragen_meldung();
	} else {
		$result .= '</table>';
	}
	return $result;
}

function keine_anfragen_meldung() {
	return '<div id="meldung" style="margin-top: 10px">Keine Anfragen vorhanden</div>';
}

function get_anfrageliste ($betreff, $kunde, $supporter, $supportart, $status) {
	$anfragen = get_anfrageliste_auswertung($betreff, $kunde, $supporter, $supportart, $status);
	$result .= "<table id='tabelle' cellpadding='0' cellspacing='0' width='960px' style='padding-top: 0px'>";
	foreach($anfragen as $anfrage) {
		$result .= "<tr>
						<td width='345px'>$anfrage[betreff]</td>
						<td width='160px'>$anfrage[kunde]</td>
						<td width='160px'>$anfrage[supporter]</td>
						<td width='207px'>$anfrage[supportart]</td>
						<td width='123px'>$anfrage[status]</td>
					</tr>";
	}
	$result .= "</table>";
	$result .= "<input type='button' value='Druckansicht' onclick='print_list()'";
	$result .= "<input id='anfragen' type='hidden' value='".serialize($anfragen)."' onclick='print_list()'";
	return $result;
}
?>