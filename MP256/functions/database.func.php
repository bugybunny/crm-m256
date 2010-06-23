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

/**
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

function get_anfrage($id) {
	$result = mysql_query("SELECT datum, betreff, problem, mitarbeiter_ref, kunden_ref, status_ref, supportart_ref");
	
	if(mysql_num_rows($result)) {
		$anfrage = mysql_fetch_assoc($result);
		return $anfrage;
	}
	return null;
	
}
?>