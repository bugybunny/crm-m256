<?php
check_login();
check_kunde();

$p_betreff = isset($p_betreff) ? trim($p_betreff) : "";
$p_problem = isset($p_problem) ? trim($p_problem) : "";

if(isset($p_erstellen)) {
	if (!validate("empty", $p_betreff)) {
		$warning['betreff'] = "Bitte Betreff eingeben";
	}
	if (!validate("empty", $p_problem)) {
		$warning['problem'] = "Bitte Problem eingeben";
	}
	if(empty($warning)){
		$datum = date("Y-m-d H:i:s");
		$kunden_id = $_SESSION['user_id'];
		if(anfrage_erstellen($datum, uml_replace($p_betreff), uml_replace($p_problem), $kunden_id, 1, $p_supportart)){
			$bestaetigung = "Die Anfrage wurde erfolgreich erstellt";
		} else {
			$bestaetigung = "Die Anfrage konnte <b>nicht</b> erstellt werden";
		}
		$bestaetigung .= "<br/><br/><u><a href='".$php_self."?site=".$site."'>Neue Anfrage erstellen</a></u>";
	}
}

$output .= "<h1>Anfrage erstellen</h1>";
if(empty($warning) && !empty($bestaetigung)){
	$output .= "<div id='meldung'>$bestaetigung</div>";
} else {
	if(!empty($warning)) { 	
		$text = "<div id='meldung'><b>Ihre Eingaben enthalten Fehler:</b><br><ul>";
		foreach($warning as $warn) 
	    $text .= "<li>".$warn."</li>"; 
	    $text .= "</ul></div>";
	    $output .= $text;
	} 
	$output .= 
	'<form name="anfrage_erstellen" action="'.$_SERVER['PHP_SELF'].'?site='.$site.'" method="post">
		<table>
			<tr>
				<td class="left" width="110px">Betreff:</td>
				<td colspan="2"><input class="input_field" style="width: 790px" id="betreff" name="betreff" type="text" value="'.$p_betreff.'" size="30" onclick="validate(this, \'empty\');" onkeyup="validate(this, \'empty\');" /></td>
				<td><div class="info" id="info_betreff">'.show_error($warning['betreff']).'</div></td>
			</tr>
			<tr valign="top">
				<td class="left">Problem:</td>
				<td colspan="2">
					<textarea class="input_field" style="width: 790px; height: 250px;" id="problem" name="problem" onclick="validate(this, \'empty\');" onkeyup="validate(this, \'empty\');">'.$p_problem.'</textarea>
				</td>
				<td><div class="info" id="info_problem">'.show_error($warning['problem']).'</div></td>
			</tr>
			<tr>
				<td class="left">Supportart:</td>
				<td>'.get_supportart_dropdown($p_supportart).'</td>
				<td align="right"><input type="submit" value="Erstellen" name="erstellen" />
			</tr>
		</table>
	</form>';
}
?>