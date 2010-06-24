<?php
define("MYSQL_HOST",     "localhost");
define("MYSQL_USER",     "root");
define("MYSQL_PASS",     "");
define("MYSQL_DATABASE", "m256_3");

function get_connection() {
	$db_link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS)
		or die("Keine Verbindung möglich : " . mysql_error());
	$db_sel = mysql_select_db(MYSQL_DATABASE, $db_link)
		or die("Datenbank nicht ausgewählt : " . mysql_error());
	return $db_link;
}

function login($username, $pw){
	$query = "SELECT id, rolle_ref FROM benutzer WHERE benutzer.login = '".$username."' AND benutzer.pw = '".md5($pw)."';";
	$return = mysql_query($query);
	$row = mysql_fetch_array($return);
	$id = $row["id"];
	if($row>=1){
		$query = "SELECT rolle FROM rolle WHERE rolle.id = ".$row["rolle_ref"].";";
		$return = mysql_query($query);
		$row = mysql_fetch_array($return);
		$rolle = $row["rolle"];
		$query = "SELECT supportart_id FROM benutzer_supportart WHERE benutzer_supportart.benutzer_id = ".$id.";";
		$return = mysql_query($query);
		$row = mysql_fetch_array($return);
		$support_id = $row["supportart_id"];
		$return_array = array("id" => $id, "rolle" => $rolle, "supportart_id" => $support_id);
	}else{
		$return_array = "";
	}
	return $return_array;
}
 
function check_username($login){
	$query = "SELECT id FROM benutzer WHERE benutzer.login = '".$login."';";
	$return = mysql_query($query);
	$row = mysql_fetch_assoc($return);
	if($row>=1)
		return true;
	return false;
}
 
function regist($login, $name, $vorname, $email, $pw){
	$query = "SELECT id FROM rolle WHERE rolle.rolle = 'Kunde';";
	$return = mysql_query($query);
	$row = mysql_fetch_assoc($return);
	$query = "INSERT INTO benutzer (login, name, vorname, email, pw, rolle_ref) VALUES ('".$login."', '".$name."', '".$vorname."', '".$email."', '".md5($pw)."', '".$row['id']."')";
	mysql_query($query);
	$query = "SELECT id FROM benutzer WHERE benutzer.login = '".$login."';";
	$return = mysql_query($query);
	$row = mysql_fetch_assoc($return);
	if($row>=1)
		return true;
	return false;
}

function anfrage_erstellen($datum, $betreff, $problem, $kunden_id, $status, $supportart) {
	// TODO: DB EINTRAG
	return true;
}

function get_supportart_dropdown($actual_select) {
	$result = mysql_query("SELECT id, supportart FROM supportart");
	$output = '<select class="input_field" name="supportart">';
	while ($row = mysql_fetch_array($result)) {
		if($actual_select == $row['id'])
			$output .= '<option value="'.$row['id'].'" selected>'.$row['supportart'].'</option>';
		else
			$output .= '<option value="'.$row['id'].'">'.$row['supportart'].'</option>';
	}
	$output .= '</select>';
	return $output;
}

/**
 * Sucht einen Kunden-Datensatz anhand der BenutzerID
 * Gibt null zurück, wenn keiner gefunden wurde
 * 
 * @param $id int Kundenid (benutzer.id)
 * @return $kunde array gefundener Kunden-Datensatz
 */
function get_kunde($id) {
    $result = mysql_query("SELECT login, name, vorname, email, pw, rolle_ref FROM benutzer WHERE benutzer.id = $id");
    if(mysql_num_rows($result)) {
        $kunde = mysql_fetch_assoc($result);
        return $kunde;
    }
    return null;
}

/**
 * Sucht einen Status-Datensatz anhand der StatusID
 * Gibt null zurück, wenn keiner gefunden wurde
 * 
 * @param $id int Statusid (status.status_id)
 * @return $status array gefundener Status-Datensatz
 */
function get_status($id) {
    $result = mysql_query("SELECT status FROM status WHERE status.status_id = $id");
    if(mysql_num_rows($result)) {
        $status = mysql_fetch_assoc($result);
        return $status;
    }
    return null;
}

/**
 * Sucht einen Anfrage-Datensatz anhand der Anfragenummer
 * Gibt null zurück, wenn keiner gefunden wurde
 * 
 * @param $anfrage_nr int Anfragenummer (anfrage.anfrage_nr)
 * @return $anfrage array gefundener Anfrage-Datensatz
 */
function get_anfrage($anfrage_nr) {
	$result = mysql_query("SELECT a.datum, a.betreff, a.problem, b.vorname, b.name, b.email, s.status FROM anfrage a JOIN (benutzer b, `status` s) ON (b.id = a.kunden_ref AND s.status_id = a.status_ref) WHERE a.anfrage_nr = $anfrage_nr");
	if(mysql_num_rows($result)) {
		$anfrage = mysql_fetch_assoc($result);
		return $anfrage;
	}
	return null;
}

// Alle Anfragen von einem Kunden, Status (Open, Working/Reworking, Done) kann optional angegeben werden
function get_anfragenliste_user($benutzer_id, $status = null) {
	if($status == null) {
		$sql = "SELECT a.anfrage_nr, a.datum, a.betreff, a.problem, b.name, b.vorname, st.status, sa.supportart FROM anfrage a, benutzer b, status st, supportart sa WHERE a.kunden_ref=".$benutzer_id." AND st.status_id= a.status_ref AND a.supportart_ref = sa.id AND a.mitarbeiter_ref = b.id;";	
	} else {
		$sql = "SELECT a.anfrage_nr, a.datum, a.betreff, a.problem, b.name, b.vorname, st.status, sa.supportart FROM anfrage a, benutzer b, status st, supportart sa WHERE a.kunden_ref=".$benutzer_id." AND a.status_ref = ".$status." AND st.status_id=".$status." AND a.supportart_ref = sa.id AND a.mitarbeiter_ref = b.id;";	
	}
	
	$result = mysql_query($sql);
	$array = array();
	$i = 0;
	echo $sql;
	while (($row = mysql_fetch_array($result))) {
		$array[$i]["anfrage_nr"] = $row["anfrage_nr"];
		$array[$i]["datum"] = $row["datum"];
		$array[$i]["betreff"] = $row["betreff"];
		$array[$i]["problem"] = $row["problem"];
		$array[$i]["mitarbeiter"] = $row["name"]." ".$row["vorname"];
		$array[$i]["status"] = $row["status"];
		$array[$i]["supportart"] = $row["supportart"];
		$i++;
	}
	return $array;
}

// Alle Anfragen wo ich supporter bin, Status (Working/Reworking, Done) kann optional angegeben werden
function get_anfragenliste_support($benutzer_id, $status = null) {
	if($status == null) {
		$sql = "SELECT a.anfrage_nr, a.datum, a.betreff, a.problem, b.name, b.vorname, st.status, sa.supportart FROM anfrage a, benutzer b, status st, supportart sa WHERE a.mitarbeiter_ref=".$benutzer_id." AND st.status_id= a.status_ref AND a.supportart_ref = sa.id AND a.kunden_ref = b.id;";
	} else {
		$sql = "SELECT a.anfrage_nr, a.datum, a.betreff, a.problem, b.name, b.vorname, st.status, sa.supportart FROM anfrage a, benutzer b, status st, supportart sa WHERE a.mitarbeiter_ref=".$benutzer_id." AND a.status_ref = ".$status." AND st.status_id=".$status." AND a.supportart_ref = sa.id AND a.kunden_ref = b.id;";
	}
	$result = mysql_query($sql);
	$array = array();
	$i = 0;
	echo $sql;
	while (($row = mysql_fetch_array($result))) {
		$array[$i]["anfrage_nr"] = $row["anfrage_nr"];
		$array[$i]["datum"] = $row["datum"];
		$array[$i]["betreff"] = $row["betreff"];
		$array[$i]["problem"] = $row["problem"];
		$array[$i]["kunde"] = $row["name"]." ".$row["vorname"];
		$array[$i]["status"] = $row["status"];
		$array[$i]["supportart"] = $row["supportart"];
		$i++;
	}
	return $array;
}
?>