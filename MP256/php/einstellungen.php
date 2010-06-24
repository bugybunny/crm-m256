<?php
$p_vorname = isset($p_vorname) ? trim($p_vorname) : "";
$p_nachname = isset($p_nachname) ? trim($p_nachname) : "";
$p_email = isset($p_email) ? trim($p_email) : "";
$p_pw_1 = isset($p_pw_1) ? trim($p_pw_1) : "";
$p_pw_2 = isset($p_pw_2) ? trim($p_pw_2) : "";

if(isset($p_save)) {
	if(validate("empty", $p_pw_1) && validate("empty", $p_pw_2)){
		if (!validate("compare", $p_pw_1, $p_pw_2)) {
	  		$warning['pw2'] = "Passwörter sind nicht gleich!";
		}
	}
	if (!validate("empty", $p_vorname)) {
		$warning['vorname'] = "Bitte Vorname eingeben";
	}
	if (!validate("empty", $p_nachname)) {
		$warning['nachname'] = "Bitte Nachname eingeben";
	}
	if (!validate("email", $p_email)) {
		$warning['email'] = "Die eingegebene E-Mail Adresse ist ungültig";
	}
	if(empty($warning)){
		if(validate("empty", $p_pw_1) && validate("empty", $p_pw_2)){
			update_benutzerdaten_passwort($_SESSION["user_id"], $p_nachname, $p_vorname, $p_email, $p_pw_1);
		} else {
			update_benutzerdaten($_SESSION["user_id"], $p_nachname, $p_vorname, $p_email);
		}
		$bestaetigung = "Das Profil wurde erfolgreich geändert.";
	}
} else {
	$user_daten = get_benutzerdaten($_SESSION["user_id"]);
	$p_vorname = $user_daten["vorname"];
	$p_nachname = $user_daten["name"];
	$p_email = $user_daten["email"];
	$info = "<b>Info:</b><i> Falls kein neues Passwort angegeben wird, werden nur die anderen Änderungen gespeichert.</i>";
}

$output .= "<h1>Einstellungen</h1>";
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
	if(!empty($info))
		$output .= "<div id='meldung'>$info</div>";
	$output .= 
	'<form name="registrierung" action="'.$_SERVER['PHP_SELF'].'?site='.$site.'" method="post">
		<table>
			<tr>
				<td class="left" width="110px">Neues Passwort:</td>
				<td><input class="input_field" id="pw1" name="pw_1" type="password" value="'.$p_pw_1.'" size="30" /></td>
				<td><div class="info" id="info_pw1">'.show_error($warning['pw1']).'</div></td>
			</tr>
			<tr>
				<td class="left">Wiederholen:</td>
				<td><input class="input_field" id="pw2" name="pw_2" type="password" value="'.$p_pw_2.'" size="30" onclick="validate(this, \'compare\', document.getElementById(\'pw1\'));" onkeyup="validate(this, \'compare\', document.getElementById(\'pw1\'));" /></td>
				<td><div class="info" id="info_pw2">'.show_error($warning['pw2']).'</div></td>
			</tr>
		</table>
		<br />
		<table>
			<tr>
				<td class="left" width="110px">Vorname:</td>
				<td><input class="input_field" id="vorname" name="vorname" type="text" value="'.$p_vorname.'" size="30" onclick="validate(this, \'empty\');" onkeyup="validate(this, \'empty\');" /></td>
				<td><div class="info" id="info_vorname">'.show_error($warning['vorname']).'</div></td>
			</tr>
			<tr>
				<td class="left">Nachname:</td>
				<td><input class="input_field" id="nachname" name="nachname" type="text" value="'.$p_nachname.'" size="30" onclick="validate(this, \'empty\');" onkeyup="validate(this, \'empty\');" /></td>
				<td><div class="info" id="info_nachname">'.show_error($warning['nachname']).'</div></td>
			</tr>
			<tr>
				<td class="left">E-Mail Adresse:</td>
				<td><input class="input_field" id="email" name="email" type="text" value="'.$p_email.'" size="30" onclick="validate(this, \'email\');" onkeyup="validate(this, \'email\');" /></td>
				<td><div class="info" id="info_email">'.show_error($warning['email']).'</div></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><input type="submit" value="Speichern" name="save" /></td>
			</tr>
		</table>
	</form>';
}
?>