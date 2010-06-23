<?php
$p_kunden_login = isset($p_kunden_login) ? trim($p_kunden_login) : "";
$p_passwort = isset($p_passwort) ? trim($p_passwort) : "";

//Überprüfung, ob schon eine Benutzer eingeloggt ist
if($logged_in) {
	header("Location: ".$_SERVER['PHP_SELF'].'?site='.$home);
} else {
	if(isset($p_login)) {
		if (!validate("empty", $p_kunden_login)) {
			$warning['login'] = "Bitte Benutzername eingeben";
		}
		if (!validate("empty", $p_passwort)) {
			$warning['passwort'] = "Bitte Passwort eingeben";
		}		
		if(empty($warning)){
			// LOGIN CHECK DB
			$login_array = login($p_kunden_login, $p_passwort);
			if(!empty($login_array)){
				$_SESSION["logged_in"] = true;
				$_SESSION["user_id"] = $login_array['id'];
				$_SESSION["user_role"] = $login_array['rolle'];
				$_SESSION["user_team"] = $login_array['supportart_id'];
				header("Location: ".$_SERVER['PHP_SELF'].'?site='.$home);
			} else {
				$warning['login'] = "Der angegebene Benutzername/Passwort ist ungültig.";
			}
		}
	}
	
	//Ausgabe der Loginmaske
	$output .= "<h1>Login</h1>";
	if(!empty($warning)) { 	
		$text = "<div id='meldung'><b>Ihre Eingaben enthalten Fehler:</b><br><ul>";
		foreach($warning as $warn) 
	    $text .= "<li>".$warn."</li>"; 
	    $text .= "</ul></div>";
	    $output .= $text;
	} 
	$output .= 
	'<form name="login" action="'.$_SERVER['PHP_SELF'].'?site='.$site.'" method="post">
		<table>
			<tr>
				<td width="80px">Benutzername:</td>
				<td><input class="input_field" id="login" name="kunden_login" type="text" size="30" value="'.$p_kunden_login.'" onclick="validate(this, \'empty\');" onkeyup="validate(this, \'empty\');" /></td>
				<td><div class="info" id="info_login">'.show_error($warning['login']).'</div></td>
			</tr>
			<tr>
				<td>Passwort:</td>
				<td><input class="input_field" id="passwort" name="passwort" type="password" size="30" onclick="validate(this, \'empty\');" onkeyup="validate(this, \'empty\');" /></td>
				<td><div class="info" id="info_passwort">'.show_error($warning['passwort']).'</div></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><input type="submit" name="login" value="Einloggen" /></td>
			</tr>
		</table>
		<br/>Sie sind noch nicht registriert? Dann können Sie sich <b><a href="'.$_SERVER['PHP_SELF'].'?site=registrieren">hier</a></b> registrieren.
	</form>';
}
?>