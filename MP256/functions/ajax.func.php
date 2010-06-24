<?php
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
			'<th>Betreff</th>
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
				$result .= '<td><a href="#"><img src="media/images/eye-arrow.png" onclick="update_list(1, '.($anfragen[$i]['anfrage']).')" border=0 alt=""></img></a></td>';
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
			'<th>Betreff</th>
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
		$result .=
			'<td><a href="index.php?site=anfrage&id='.$anfragen[$i]['anfrage_nr'].'">'.($anfragen[$i]['betreff']).'</a></td>
		</tr>';
	}
	if(count($anfragen) == 0){
		$result = keine_anfragen_meldung();
	} else {
		$result .= '</table>';
	}
	return $result;
}

function get_supporter_anfragen($mitarbeiter_id, $status_id = 2){
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
		$result .=
			'<th width="200px">Supportart</th>';
	}
	$result .=
			'<th>Betreff</th>
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
		$result .=
			'<td><a href="index.php?site=anfrage&id='.$anfragen[$i]['anfrage_nr'].'">'.($anfragen[$i]['betreff']).'</a></td>
		</tr>';
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

function get_anfrageliste ($searchtype, $value) {
	$datum = null;
	$betreff = null;
	$problem = null;
	$status = null;
	$supportart = null;

	switch($searchtype) {
		case "datum":
			$datum = $value;
			break;
		case "betreff":
			$betreff = $value;
			break;
		case "problem":
			$problem = $value;
			break;
		case "status":
			$status = $value;
			break;	
		case "betreff":
			$supportart = $value;
			break;
	}
	
	$anfragen = get_anfrageliste_auswertung($datum, $betreff, $problem, $status, $supportart);
	$result .=   "<table>
			   	    <tr>
			    		<th>Betreff</th><th>Kunde</th><th>Problem</th></th><th>Mitarbeiter</th>
			    	</tr>
					<tr>
						<td><input type='text' name='suche_datum' onkeyup='search_datum(this.value)' />
						<td><input type='text' name='suche_betreff' onkeyup='search_betreff(this.value)' />
						<td><input type='text' name='suche_problem' onkeyup='search_problem(this.value)' />
						<td><input type='text' name='suche_status' onkeyup='search_status(this.value)' />
						<td><input type='text' name='suche_supportart' onkeyup='search_supportart(this.value)'/>	
					</tr>";
	
	foreach($anfragen as $anfrage) {
		$result .= "<tr>
						<td>$anfrage[datum]</td>
						<td>$anfrage[betreff]</td>
						<td>$anfrage[problem]</td>
						<td>$anfrage[status]</td>
						<td>$anfrage[supportart]</td>
					</tr>";
	}
	
	$result .= "</table>";
	
	return $result;
}
?>