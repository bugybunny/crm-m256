<?php
$p_kunden_login = isset($p_kunden_login) ? trim($p_kunden_login) : "";
$p_vorname = isset($p_vorname) ? trim($p_vorname) : "";
$p_nachname = isset($p_nachname) ? trim($p_nachname) : "";
$p_email = isset($p_email) ? trim($p_email) : "";
$p_pw_1 = isset($p_pw_1) ? trim($p_pw_1) : "";
$p_pw_2 = isset($p_pw_2) ? trim($p_pw_2) : "";

if(isset($p_registrieren)) {
	if (empty($p_email) || strlen($p_email) <= 0) {
		$warning[] = "Bitte E-Mail Adresse eingeben";
	}
	if (empty($p_pw_1) || strlen($p_pw_1) <= 0) {
		$warning[] = "Bitte Passwort eingeben";
	}
	if (empty($p_pw_2) || strlen($p_pw_2) <= 0) {
		$warning[] = "Bitte zweites Passwort eingeben";
	}
	if(!empty($p_pw_1) && !empty($p_pw_2)){
		if($p_pw_2 != $p_pw_1){
	  		$warning[] = "Passwörter sind nicht gleich!";
		}
	}
	if (empty($p_vorname) || strlen($p_vorname) <= 0) {
		$warning[] = "Bitte Vorname eingeben";
	}
	if (empty($p_nachname) || strlen($p_nachname) <= 0) {
		$warning[] = "Bitte Nachname eingeben";
	}
	if (empty($p_kunden_login) || strlen($p_kunden_login) <= 0) {
		$warning[] = "Bitte Login eingeben";
	}
	if(empty($warning)){
		// BENUTZER REGISTRIEREN (DB)
		$bestaetigung = "Erfolgreich registriert";
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
				<td><input class="input_field" name="kunden_login" type="text" value="'.$p_kunden_login.'" size="30"></td>
			</tr>	
			<tr>
				<td class="left">Neues Passwort:</td>
				<td><input class="input_field" name="pw_1" type="password" value="'.$p_pw_1.'" size="30" /></td>
			</tr>
			<tr>
				<td class="left">Wiederholen:</td>
				<td><input class="input_field" name="pw_2" type="password" value="'.$p_pw_2.'" size="30" /></td>
			</tr>
		</table>
		<br />
		<table>
			<tr>
				<td class="left" width="110px">Vorname:</td>
				<td><input class="input_field" name="vorname" type="text" value="'.$p_vorname.'" size="30" /></td>
			</tr>
			<tr>
				<td class="left">Nachname:</td>
				<td><input class="input_field" name="nachname" type="text" value="'.$p_nachname.'" size="30" /></td>
			</tr>
			<tr>
				<td class="left">E-Mail Adresse:</td>
				<td><input class="input_field" name="email" type="text" value="'.$p_email.'" size="30"> <input type="submit" value="Registrieren" name="registrieren" /></td>
			</tr>
		</table>
	</form>';
}
?>