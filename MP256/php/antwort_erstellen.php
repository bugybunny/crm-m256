<?php
check_login();
check_mitarbeiter();

$p_antwort = isset($p_antwort) ? trim($p_antwort) : "";
$anfrage_id = isset($g_id) ? trim($g_id) : "";

if(isset($p_antworten)) {
	if (!validate("empty", $p_antwort)) {
		$warning['antwort'] = "Bitte eine Antwort eingeben";
	}
	if(empty($warning)){
		$datum = date("Y-m-d H:i:s");
		if(antwort_erstellen($datum, $p_antwort, $anfrage_id)){
			$bestaetigung = "Die Antwort wurde erfolgreich erstellt";
			$bestaetigung .= "<br/><br/><a href='".$php_self."?site=anfrage&id=".$anfrage_id."'>Zur Anfrage</a>";
		} else {
			$bestaetigung = "Die Antwort konnte nicht erstellt werden";
		}
	}
}

$output .= "<h1>Antwort erstellen</h1>";
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
	'<form name="antwort_erstellen" action="'.$_SERVER['PHP_SELF'].'?site='.$site.'&id='.$anfrage_id.'" method="post">
		<table>
			<tr valign="top">
				<td class="left" width="110px">Antwort:</td>
				<td colspan="2">
					<textarea class="input_field" style="width: 790px; height: 250px;" id="antwort" name="antwort" onclick="validate(this, \'empty\');" onkeyup="validate(this, \'empty\');">'.$p_antwort.'</textarea>
				</td>
				<td><div class="info" id="info_antwort">'.show_error($warning['antwort']).'</div></td>
			</tr>
			<tr>
				<td colspan="3" align="right"><input type="submit" value="Antworten" name="antworten" />
			</tr>
		</table>
	</form>';
}
?>