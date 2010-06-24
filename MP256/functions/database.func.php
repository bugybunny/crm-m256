<?php
define("MYSQL_HOST",     "localhost");
define("MYSQL_USER",     "root");
define("MYSQL_PASS",     "");
define("MYSQL_DATABASE", "m256_3");

/**
 * Stellt eine Verbindung mit der Datenbank her
 *
 * @return $db_link resource Datenbank-Verbindung
 */
function get_connection() {
	$db_link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS)
	or die("Keine Verbindung möglich : " . mysql_error());
	$db_sel = mysql_select_db(MYSQL_DATABASE, $db_link)
	or die("Datenbank nicht ausgewählt : " . mysql_error());
	return $db_link;
}

/**
 * Prüft ob die Logindaten korrekt sind und gibt die Benutzerinformationen zurück,
 * falls das Login erfolgreich war.
 *
 * @param $username string Benutzername
 * @param $pw string Benutzerpasswort, reiner Text (noch nicht verschlüsselt)
 * @return $return_array array Ergebnisarray mit BenutzerID, Rolle und der SupportartID. Leer wenn Login falsch
 */
function login($username, $pw){
	$sql = "SELECT id, rolle_ref FROM benutzer WHERE benutzer.login = '".$username."' AND benutzer.pw = '".md5($pw)."';";
	$return = mysql_query($sql);
	$row = mysql_fetch_assoc($return);
	$id = $row["id"];
	if($row>=1){
		$sql = "SELECT rolle FROM rolle WHERE rolle.id = ".$row["rolle_ref"].";";
		$return = mysql_query($sql);
		$row = mysql_fetch_assoc($return);
		$rolle = $row["rolle"];
		$sql = "SELECT supportart_id FROM benutzer_supportart WHERE benutzer_supportart.benutzer_id = ".$id.";";
		$return = mysql_query($sql);
		$row = mysql_fetch_assoc($return);
		$support_id = $row["supportart_id"];
		$return_array = array("id" => $id, "rolle" => $rolle, "supportart_id" => $support_id);
	}else{
		$return_array = "";
	}
	return $return_array;
}

/**
 * Prüft ob ein Benutzername schon vorhanden ist
 *
 * @param $username string zu überprüfender Benutzername
 * @return boolean true wenn Benutzername schon vorhanden, false wenn nicht
 */
function check_username($username){
	$sql = "SELECT id FROM benutzer WHERE benutzer.login = '".$username."';";
	$return = mysql_query($sql);
	return(mysql_num_rows($return));
}

/**
 * Erstellt ein neues Kunden-Benutzerkonto
 *
 * @param $username string Benutzername
 * @param $name string Benutzernachname
 * @param $vorname string Benutzervorname
 * @param $email string Benutzeremail
 * @param $pw string Benutzerpasswort, reiner Text (noch nicht verschlüsselt)
 * @return boolean true wenn die Registration erfolgreich war und der Account erstellt wurde, false wenn nicht
 */
function regist($username, $name, $vorname, $email, $pw){
	$sql = "SELECT id FROM rolle WHERE rolle.rolle = 'Kunde';";
	$return = mysql_query($sql);
	$row = mysql_fetch_assoc($return);
	$sql = "INSERT INTO benutzer (login, name, vorname, email, pw, rolle_ref) VALUES ('".$username."', '".$name."', '".$vorname."', '".$email."', '".md5($pw)."', '".$row['id']."')";
	mysql_query($sql);
	$sql = "SELECT id FROM benutzer WHERE benutzer.login = '".$username."';";
	$return = mysql_query($sql);
	$row = mysql_fetch_assoc($return);
	if(empty($return)) return false;
	if($row>=1)
	return true;
	return false;
}

/**
 * Erstellt einen Anfrage-Datensatz in der DB
 *
 * @param $datum string Erstelldatum (Datetime Y-m-d H:i:s)
 * @param $betreff Anfragenbetreff
 * @param $problem string Anfragenproblem
 * @param $kunden_id int Kunden_ref
 * @param $status int Status_ref
 * @param $supportart int Support_ref
 * @return boolean true wenn die Anfrage erstellt wurde, false wenn nicht
 */
function anfrage_erstellen($datum, $betreff, $problem, $kunden_id, $status, $supportart) {
	$betreff = mysql_escape_string($betreff);
	$problem = mysql_escape_string($problem);
	$sql = "INSERT INTO anfrage (datum, betreff, problem, kunden_ref, status_ref, supportart_ref)
            	VALUES('".$datum."', '".$betreff."', '".$problem."', ".$kunden_id.", ".$status.", ".$supportart.");";
	mysql_query($sql);
	$sql = "SELECT anfrage_nr FROM anfrage WHERE datum = '".$datum."' AND betreff='".$betreff."' AND problem='".$problem."' AND kunden_ref=".$kunden_id." AND status_ref=".$status." AND supportart_ref=".$supportart.";";
	$return = mysql_query($sql);
	if(empty($return)) return false;
	$row = mysql_fetch_assoc($return);
	if ($row >= 1)
	return true;
	return false;
}

/**
 * Liefert den HTML-Code für eine Dropdownliste mit allen Supportarten zurück
 *
 * @param $actual_select int Standardmässig ausgewählte SupportartID
 * @return $output string HTML-Code für die Dropdownliste
 */
function get_supportart_dropdown($actual_select) {
	$sql = "SELECT id, supportart FROM supportart";
	$return = mysql_query($sql);
	$output = '<select class="input_field" name="supportart">';
	if(mysql_num_rows($return)) {
		while ($row = mysql_fetch_assoc($return)) {
			if($actual_select == $row['id'])
				$output .= '<option value="'.$row['id'].'" selected>'.$row['supportart'].'</option>';
			else
				$output .= '<option value="'.$row['id'].'">'.$row['supportart'].'</option>';
		}
	}
	$output .= '</select>';
	return $output;
}

/**
 * Liefert den HTML-Code für eine Dropdownliste mit allen Supportarten zurück
 *
 * @param $actual_select int Standardmässig ausgewählte SupportartID
 * @return $output string HTML-Code für die Dropdownliste
 */
function get_supportart_dropdown2($onchange = null, $actual_select = 0) {
	$sql = "SELECT id, supportart FROM supportart";
	$return = mysql_query($sql);
	$output = '<select class="input_field" id="suche_supportart" name="supportart"';
	if($onchange != null) {
		$output .= ' onchange="'.$onchange.'"';
	}
	$output .= '>';
	$output .= '<option value="0" ';	
	if($actual_select === 0)
		$output .= 'selected ';
	$output .= '>Alle</option>';
 	if(mysql_num_rows($return)) {
		while ($row = mysql_fetch_assoc($return)) {
			if($actual_select == $row['id'])
				$output .= '<option value="'.$row['id'].'" selected>'.$row['supportart'].'</option>';
			else
				$output .= '<option value="'.$row['id'].'">'.$row['supportart'].'</option>';
		}
	}
	$output .= '</select>';
	return $output;
}

/**
 * Liefert den HTML-Code für eine Dropdownliste mit allen Stati zurück
 *
 * @param $actual_select int Standardmässig ausgewählte StatusID, optional
 * @return $output string HTML-Code für die Dropdownliste
 */
function get_status_dropdown($onchange = null, $actual_select = 0) {
	$sql = "SELECT status_id, status FROM status";
	$return = mysql_query($sql);
	$output = '<select class="input_field" id="suche_status" name="status"';
	if($onchange != null) {
		$output .= ' onchange="'.$onchange.'"';
	}
	$output .= '>';
	$output .= '<option value="0" ';	
	if($actual_select === 0)
		$output .= 'selected ';
	$output .= '>Alle</option>';
 	if(mysql_num_rows($return)) {
		while ($row = mysql_fetch_assoc($return)) {
			if($actual_select == $row['status_id'])
				$output .= '<option value="'.$row['status_id'].'" selected>'.$row['status'].'</option>';
			else
				$output .= '<option value="'.$row['status_id'].'">'.$row['status'].'</option>';
		}
	}
	$output .= '</select>';
	return $output;
}

/**
 * Sucht nach einem Kunden per BenutzerID
 * 
 * @param $id int Kundenid (benutzer.id)
 * @return $kunde array gefundener Kunden-Datensatz, null wenn kein Kunde gefunden
 */
function get_kunde($id) {
	$sql = "SELECT login, name, vorname, email, pw, rolle_ref FROM benutzer WHERE benutzer.id=".$id;
	$return = mysql_query($sql);
	if(mysql_num_rows($return)) {
		$kunde = mysql_fetch_assoc($return);
		return $kunde;
	}
	return null;
}

/**
 * Sucht nach einem Status per StatusID
 * 
 * @param $id int Statusid (status.status_id)
 * @return $status array gefundener Status-Datensatz, null wenn kein Status gefunden
 */
function get_status($id) {
	$sql = "SELECT status FROM status WHERE status.status_id = ".$id;
	$return = mysql_query($sql);
	if(mysql_num_rows($return)) {
		$status = mysql_fetch_assoc($return);
		return $status;
	}
	return null;
}

function is_anfrage_supporter($user_id, $anfrage_id){
	$sql = "SELECT * FROM anfrage WHERE anfrage_nr = '".$anfrage_id."' AND mitarbeiter_ref='".$user_id."';";
	$return = mysql_query($sql);
	if(empty($return)) return false;
	$row = mysql_fetch_assoc($return);
	if ($row >= 1)
		return true;
	return false;
}

function get_anfrage($anfrage_nr) {
	GLOBAL $is_mitarbeiter;
	if($is_mitarbeiter){
		return get_anfrage_mitarbeiter($anfrage_nr);
	}
	return get_anfrage_kunde($anfrage_nr);
}

function get_anfrage_kunde($anfrage_nr){
	$sql = "SELECT DISTINCT a.datum, a.betreff, a.problem, CONCAT(b.vorname, ' ', b.name) as kunde, s.status, sa.supportart
                FROM anfrage a JOIN (benutzer b, `status` s, supportart sa) ON (b.id = a.kunden_ref AND s.status_id = a.status_ref AND sa.id = a.supportart_ref)
                WHERE a.anfrage_nr = ".$anfrage_nr." AND (a.kunden_ref=".$_SESSION['user_id'].")";
	$return = mysql_query($sql);
	if(mysql_num_rows($return)) {
		$anfrage = mysql_fetch_assoc($return);
		return $anfrage;
	}
	return null;
}

function get_anfrage_mitarbeiter($anfrage_nr){
	$sql = "SELECT DISTINCT a.datum, a.betreff, a.problem, CONCAT(b.vorname, ' ', b.name) as kunde, s.status, sa.supportart
                FROM anfrage a JOIN (benutzer b, `status` s, supportart sa, benutzer_supportart b_sa) ON (b.id = a.kunden_ref AND s.status_id = a.status_ref AND sa.id = a.supportart_ref AND b_sa.supportart_id = a.supportart_ref)
                WHERE a.anfrage_nr = ".$anfrage_nr." AND (b_sa.benutzer_id = ".$_SESSION['user_id'].")";
	$return = mysql_query($sql);
	if(mysql_num_rows($return)) {
		$anfrage = mysql_fetch_assoc($return);
		return $anfrage;
	}
	return null;
}

function get_anfragenliste_supportteam($status_id, $mitarbeiter_id){
	$sql = "SELECT
              a.anfrage_nr as anfrage,
              CONCAT(b.vorname, ' ', b.name) as kunde,
              CONCAT(bma.vorname, ' ', bma.name) as supporter,
              sa.supportart as supportart,
              a.betreff as betreff
            FROM
              anfrage a
            LEFT JOIN
              supportart sa ON sa.id = a.supportart_ref
            LEFT JOIN
              benutzer b ON b.id = a.kunden_ref
            LEFT JOIN
              benutzer bma ON bma.id = a.mitarbeiter_ref
            LEFT JOIN
              benutzer_supportart bs ON bs.benutzer_id = ".$mitarbeiter_id."
            WHERE
              bs.supportart_id = a.supportart_ref AND a.status_ref = ".$status_id.";";
	$return = mysql_query($sql);
	$array = array();
	while(($row = mysql_fetch_assoc($return))){
		$array[] = $row;
	}
	return $array;
}

// Alle Anfragen von Status (Open, Working/Reworking, Done)
function get_anfragenliste_user($benutzer_id, $status) {
	$sql = "SELECT
			  a.anfrage_nr,
			  a.datum,
			  a.betreff,
			  b.name,
			  b.vorname,
			  st.status,
			  sa.supportart
			FROM
			  anfrage a
			LEFT JOIN
			  benutzer b ON b.id = a.mitarbeiter_ref
			LEFT JOIN
			  supportart sa ON sa.id = a.supportart_ref
			LEFT JOIN
			  status st ON st.status_id=a.status_ref
			WHERE
			  a.kunden_ref=".$benutzer_id."
			  AND a.status_ref = ".$status.";";
	$result = mysql_query($sql);
	$array = array();
	$i = 0;
	while (($row = mysql_fetch_array($result))) {
		$array[$i]["anfrage_nr"] = $row["anfrage_nr"];
		$array[$i]["datum"] = $row["datum"];
		$array[$i]["betreff"] = $row["betreff"];
		$array[$i]["mitarbeiter"] = $row["name"]." ".$row["vorname"];
		$array[$i]["status"] = $row["status"];
		$array[$i]["supportart"] = $row["supportart"];
		$i++;
	}
	return $array;
}

// Alle Anfragen wo ich supporter bin (Working/Reworking, Done)
function get_anfragenliste_support($benutzer_id, $status) {
	$sql = "SELECT a.anfrage_nr, a.datum, a.betreff, b.name, b.vorname, st.status, sa.supportart FROM anfrage a, benutzer b, status st, supportart sa WHERE a.mitarbeiter_ref=".$benutzer_id." AND a.status_ref = ".$status." AND st.status_id=".$status." AND a.supportart_ref = sa.id AND a.kunden_ref = b.id;";
	$result = mysql_query($sql);
	$array = array();
	$i = 0;
	while (($row = mysql_fetch_array($result))) {
		$array[$i]["anfrage_nr"] = $row["anfrage_nr"];
		$array[$i]["datum"] = $row["datum"];
		$array[$i]["betreff"] = $row["betreff"];
		$array[$i]["kunde"] = $row["name"]." ".$row["vorname"];
		$array[$i]["status"] = $row["status"];
		$array[$i]["supportart"] = $row["supportart"];
		$i++;
	}
	return $array;
}

function get_anfrageliste_auswertung ($betreff = null, $kunde = null, $supporter = null, $supportart = null, $status = null) {
	$anfragen = array();

	$sql = "SELECT
				a.anfrage_nr,
				a.betreff,
				a.problem,
				a.status_ref,
				a.supportart_ref,
				s.status,
				sa.supportart,
	            CONCAT(b.vorname, ' ', b.name) as kunde,
	            CONCAT(bma.vorname, ' ', bma.name) as supporter
			FROM anfrage a
			LEFT JOIN
				`status` s ON s.status_id = a.status_ref
	        LEFT JOIN
              	supportart sa ON sa.id = a.supportart_ref
            LEFT JOIN
              	benutzer b ON b.id = a.kunden_ref
            LEFT JOIN
            	benutzer bma ON bma.id = a.mitarbeiter_ref			
			WHERE TRUE";	
	
	if(!empty($betreff)) {
		$sql .= " AND a.betreff LIKE '$betreff%' ";
	}
	if(!empty($kunde)) {
		// Kunden Suchname in Vor- und Nachname splitten
		// Sobald ein Leerzeichen enthalten ist, wird angenommen beim letzten Teil handle es sich um den Nachnamen		
		$kunde = explode(" ", $kunde);
		if(count($kunde) > 1)
			$sql .= " AND b.vorname = '$kunde[0]' AND b.name LIKE '$kunde[1]%' ";
		else 
			$sql .= " AND b.vorname LIKE '$kunde[0]%' ";
	}
	if(!empty($supporter)) {
		// Supporter Suchname in Vor- und Nachname splitten
		// Sobald ein Leerzeichen enthalten ist, wird angenommen beim letzten Teil handle es sich um den Nachnamen		
		$supporter = explode(" ", $supporter);
		if(count($supporter) > 1)
			$sql .= " AND bma.vorname = '$supporter[0]' AND bma.name LIKE '$supporter[1]%' ";
		else 
			$sql .= " AND bma.vorname LIKE '$supporter[0]%' ";
	}
	if(!empty($supportart)) {
		$sql .= " AND a.supportart_ref = $supportart ";
	}
	if(!empty($status)) {
		$sql .= " AND a.status_ref = $status ";
	} 
	$result = mysql_query($sql);
	if(mysql_num_rows($result)) {
		while($anfrage = mysql_fetch_assoc($result)) {
			$anfragen[] = $anfrage;
		}
	}
	return $anfragen;
}

function working_anfrage($mitarbeiter_id, $anfrage_id){
	$sql = "UPDATE anfrage SET status_ref=2, mitarbeiter_ref=".$mitarbeiter_id." WHERE anfrage_nr=".$anfrage_id;
	mysql_query($sql);
}

function get_benutzerdaten($user_id){
	$sql = "SELECT name, vorname, email FROM benutzer b WHERE b.id=".$user_id;
	$return = mysql_query($sql);
	$array = array();
	while (($row = mysql_fetch_assoc($return))) {
		$array["name"] = $row["name"];
		$array["vorname"] = $row["vorname"];
		$array["email"] = $row["email"];
	}
	return $array;
}

function update_benutzerdaten($user_id, $name, $vorname, $email){
	$sql = "UPDATE benutzer SET name = '".$name."', vorname = '".$vorname."', email = '".$email."' WHERE id = '".$user_id."';";
	$return = mysql_query($sql);
}

function update_benutzerdaten_passwort($user_id, $name, $vorname, $email, $pw){
	$sql = "UPDATE benutzer SET name = '".$name."', vorname = '".$vorname."', email = '".$email."', pw='".md5($pw)."' WHERE id = '".$user_id."';";
	$return = mysql_query($sql);
}

function antwort_erstellen($datum, $antwort, $anfrage_nr){
	$sql = "INSERT INTO antwort (datum, antwort, anfrage_ref)
                  VALUES('".$datum."', '".$antwort."', ".$anfrage_nr.");";
	mysql_query($sql);
	$sql = "SELECT id FROM antwort WHERE datum = '".$datum."' AND antwort='".$antwort."' AND anfrage_ref=".$anfrage_nr.";";
	$return = mysql_query($sql);
	if(empty($return)) return false;
	$row = mysql_fetch_assoc($return);
	if ($row >= 1){
		$sql = "UPDATE anfrage SET status_ref = 3 WHERE anfrage_nr=$anfrage_nr;";
		$return = mysql_query($sql);
		return true;
	}
	return false;
}

function get_antwort($anfrage_nr){
	$sql = "SELECT a.datum, a.antwort, CONCAT(b.vorname, ' ', b.name) as supporter FROM antwort a, anfrage an, benutzer b WHERE a.anfrage_ref = ".$anfrage_nr." AND an.anfrage_nr=a.anfrage_ref AND b.id=an.mitarbeiter_ref;";
	$return = mysql_query($sql);
	if(mysql_num_rows($return)) {
		$antwort = mysql_fetch_assoc($return);
		return $antwort;
	}
	return null;
}
?>
