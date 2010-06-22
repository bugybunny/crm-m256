<?php
$p_kunden_login = isset($p_kunden_login) ? trim($p_kunden_login) : "";
$p_passwort = isset($p_passwort) ? trim($p_passwort) : "";

//�berpr�fung, ob schon eine Benutzer eingeloggt ist
if($logged_in) {
	header("Location: ".$_SERVER['PHP_SELF'].'?site='.$home);
} else {
	if(isset($p_login)) {
		if(!empty($p_kunden_login) && !empty($p_passwort)){
			// LOGIN CHECK DB
			if(true){
				// EVTL USER DATEN SPEICHERN
				$_SESSION["logged_in"] = true;
				header("Location: ".$_SERVER['PHP_SELF'].'?site='.$home);
			} else {
				$meld = "Der angegebene Login/Passwort ist ung�ltig.";
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
				<td><input name="kunden_login" type="text" size="30" value="'.$p_kunden_login.'"></td>
			</tr>
			<tr>
				<td>Passwort:</td>
				<td><input name="passwort" type="password" size="30" > <input type="submit" name="login" value="Einloggen" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<br/>Sie sind noch nicht registriert? Dann k�nnen Sie sich <b><a href="'.$_SERVER['PHP_SELF'].'?site=registrieren">hier</a></b> registrieren.
				</td>
			</tr>
		</table>
	</form>';
}
?>