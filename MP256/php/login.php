<?php
$p_kunden_login = isset($p_kunden_login) ? trim($p_kunden_login) : "";
$p_passwort = isset($p_passwort) ? trim($p_passwort) : "";

//Überprüfung, ob schon eine Benutzer eingeloggt ist
if($logged_in) {
	header("Location: ".$_SERVER['PHP_SELF'].'?site='.$home);
} else {
	if(isset($p_login)) {
		if(!empty($p_kunden_login) && !empty($p_passwort)){
			// LOGIN CHECK DB
			$login_array = login($p_kunden_login, $p_passwort);
			if(!empty($login_array)){
				$_SESSION["logged_in"] = true;
				$_SESSION["user_id"] = $login_array['id'];
				$_SESSION["user_role"] = $login_array['rolle'];
				$_SESSION["user_team"] = $login_array['supportart_id'];
				header("Location: ".$_SERVER['PHP_SELF'].'?site='.$home);
			} else {
				$meld = "Der angegebene Login/Passwort ist ungültig.";
			}
		} else { 
			$meld = "Bitte Login & Passwort eingeben."; 
		}
	}
	
	//Ausgabe der Loginmaske
	$output .= "<h1>Login</h1>";
	if(!empty($meld)) { 	
		$text = "<div id='meldung'><b>Ihre Eingaben enthalten Fehler:</b><br><ul>";
	    $text .= "<li>".$meld."</li>"; 
	    $text .= "</ul></div>";
	    $output .= $text;
	} 
	$output .= 
	'<form name="login" action="'.$_SERVER['PHP_SELF'].'?site='.$site.'" method="post">
		<table>
			<tr>
				<td width="80px">Login:</td>
				<td><input class="input_field" name="kunden_login" type="text" size="30" value="'.$p_kunden_login.'"></td>
			</tr>
			<tr>
				<td>Passwort:</td>
				<td><input class="input_field" name="passwort" type="password" size="30" > <input type="submit" name="login" value="Einloggen" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<br/>Sie sind noch nicht registriert? Dann können Sie sich <b><a href="'.$_SERVER['PHP_SELF'].'?site=registrieren">hier</a></b> registrieren.
				</td>
			</tr>
		</table>
	</form>';
}
?>