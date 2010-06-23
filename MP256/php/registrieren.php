<?php
$p_kunden_login = isset($p_kunden_login) ? trim($p_kunden_login) : "";
$p_vorname = isset($p_vorname) ? trim($p_vorname) : "";
$p_nachname = isset($p_nachname) ? trim($p_nachname) : "";
$p_email = isset($p_email) ? trim($p_email) : "";
$p_pw_1 = isset($p_pw_1) ? trim($p_pw_1) : "";
$p_pw_2 = isset($p_pw_2) ? trim($p_pw_2) : "";

if(isset($p_registrieren)) {
	if (!validate("username", $p_kunden_login)) {
		$warning['kunden_login'] = "Benutzername falsch oder bereits vorhanden";
	}
	if (!validate("empty", $p_pw_1)) {
		$warning['pw1'] = "Bitte Passwort eingeben";
	}
	if (!validate("empty", $p_pw_2)) {
		$warning['pw2'] = "Bitte zweites Passwort eingeben";
	}
	if(!empty($p_pw_1) && !empty($p_pw_2)){
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
		$warning['email'] = "Bitte E-Mail Adresse eingeben";
	}
	if(empty($warning)){
		if(regist($p_kunden_login, $p_nachname, $p_vorname, $p_email, $p_pw_1)){
			$bestaetigung = "Der Benutzer '<b>$p_kunden_login</b>' wurde erfolgreich registriert";
		} else {
			$bestaetigung = "Der Benutzer '<b>$p_kunden_login</b>'s konnte nicht registriert werden.";
		}
	}
}

$output .= "<h1>Registrierung</h1>";
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
	'<form name="registrierung" action="'.$_SERVER['PHP_SELF'].'?site='.$site.'" method="post">
		<table>
			<tr>
				<td class="left" width="110px">Benutzername:</td>
				<td><input class="input_field" id="username" name="kunden_login" type="text" value="'.$p_kunden_login.'" size="30" onkeyup="validate(this, \'username\');" /></td>
				<td><div class="info" id="info_username">'.show_error($warning['kunden_login']).'</div></td>
			</tr>	
			<tr>
				<td class="left">Neues Passwort:</td>
				<td><input class="input_field" id="pw1" name="pw_1" type="password" value="'.$p_pw_1.'" size="30" onkeyup="validate(this, \'empty\');" /></td>
				<td><div class="info" id="info_pw1">'.show_error($warning['pw1']).'</div></td>
			</tr>
			<tr>
				<td class="left">Wiederholen:</td>
				<td><input class="input_field" id="pw2" name="pw_2" type="password" value="'.$p_pw_2.'" size="30" onkeyup="validate(this, \'empty\');" /></td>
				<td><div class="info" id="info_pw2">'.show_error($warning['pw2']).'</div></td>
			</tr>
		</table>
		<br />
		<table>
			<tr>
				<td class="left" width="110px">Vorname:</td>
				<td><input class="input_field" id="vorname" name="vorname" type="text" value="'.$p_vorname.'" size="30" onkeyup="validate(this, \'empty\');" /></td>
				<td><div class="info" id="info_vorname">'.show_error($warning['vorname']).'</div></td>
			</tr>
			<tr>
				<td class="left">Nachname:</td>
				<td><input class="input_field" id="nachname" name="nachname" type="text" value="'.$p_nachname.'" size="30" onkeyup="validate(this, \'empty\');" /></td>
				<td><div class="info" id="info_nachname">'.show_error($warning['nachname']).'</div></td>
			</tr>
			<tr>
				<td class="left">E-Mail Adresse:</td>
				<td><input class="input_field" id="email" name="email" type="text" value="'.$p_email.'" size="30" onkeyup="validate(this, \'email\');" /></td>
				<td><div class="info" id="info_email">'.show_error($warning['email']).'</div></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><input type="submit" value="Registrieren" name="registrieren" /></td>
			</tr>
		</table>
		<input type="hidden" id="home_url" value="/webapps/MP256/" />
	</form>';
}

function show_error($warning) {
	if(!empty($warning))
		return '<img src="media/images/nok.png" alt="" border="0" />';
	return '';
}
?>