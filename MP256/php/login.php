<?php
$p_kunden_nr = isset($p_kunden_nr) ? trim($p_kunden_nr) : "";
$p_passwort = isset($p_passwort) ? trim($p_passwort) : "";

//Überprüfung, ob schon eine Benutzer eingeloggt ist
if($logged_in) {
	header("Location: ".$_SERVER['PHP_SELF'].'?site='.$home);
} else {
	if(isset($p_login)) {
		if(!empty($p_kunden_nr) && !empty($p_passwort)){
			// LOGIN CHECK DB
			if(true){
				// EVTL USER DATEN SPEICHERN
				$_SESSION["logged_in"] = true;
				header("Location: ".$_SERVER['PHP_SELF'].'?site='.$home);
			} else {
				$meld = "Der angegebene Kunde/Passwort ist ungültig.";
			}
		} else { 
			$meld = "Bitte Kundennummer & Passwort eingeben."; 
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
	$output .= "<form name='login' action='".$_SERVER['PHP_SELF']."?site=".$site."' method='post'>";
	$output .= '<table cellpadding="0" cellspacing="0">
			<tr>
				<td width="110px">Kundennummer:</td>
				<td><input name="kunden_nr" type="text" size="30" value="'.$p_kunden_nr.'"></td>
			</tr>
			<tr>
				<td>Passwort:</td>
				<td><input name="passwort" type="password" size="30" ></td>
			</tr>
			<input type="hidden" name="login" value="true" />
			<tr>
				<td>&nbsp;</td>
				<td align="right">
					<input type="submit" name="login" value="Einloggen" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<br/>Sie sind noch nicht registriert? Dann können Sie sich <b><a href="'.$_SERVER['PHP_SELF'].'?site=registrieren">hier</a></b> registrieren.
				</td>
			</tr>
		</table>
	</form>
</div>';
}
?>