<?php
define("MYSQL_HOST",     "localhost");
define("MYSQL_USER",     "root");
define("MYSQL_PASS",     "");
define("MYSQL_DATABASE", "m256_3");

function get_connection() {
    $db_link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS)
    or die("Keine Verbindung m�glich : " . mysql_error());
    $db_sel = mysql_select_db(MYSQL_DATABASE, $db_link)
    or die("Datenbank nicht ausgew�hlt : " . mysql_error());
    return $db_link;
}

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

function check_username($username){
    $sql = "SELECT id FROM benutzer WHERE benutzer.login = '".$username."';";
    $return = mysql_query($sql);
    $row = mysql_fetch_assoc($return);
    if(empty($return)) return false;
    if($row>=1)
   		return true;
    return false;
}

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

function get_supportart_dropdown($actual_select) {
	$sql = "SELECT id, supportart FROM supportart";
    $return = mysql_query($sql);
    $output = '<select class="input_field" name="supportart">';
    while ($row = mysql_fetch_assoc($return)) {
        if($actual_select == $row['id'])
        $output .= '<option value="'.$row['id'].'" selected>'.$row['supportart'].'</option>';
        else
        $output .= '<option value="'.$row['id'].'">'.$row['supportart'].'</option>';
    }
    $output .= '</select>';
    return $output;
}

/**
 * @param $id int Kundenid (benutzer.id)
 * @return $kunde array gefundener Kunden-Datensatz
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
 * @param $id int Statusid (status.status_id)
 * @return $status array gefundener Status-Datensatz
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

// TODO kundenname suche
function get_anfrageliste_auswertung ($datum = null, $betreff = null, $problem = null, $status = null, $supportart = null) {
	$anfragen = array();
	
	$sql = "SELECT a.anfrage_nr, a.datum, a.betreff, a.problem, a.status_ref, a.supportart_ref, s.status, sa.supportart FROM anfrage a JOIN (`status` s, supportart sa) ON (s.status_id = a.status_ref AND sa.id = a.supportart_ref) WHERE TRUE ";
	if($datum != null) {
		$sql .= " AND a.datum LIKE '$datum%' ";
	} elseif($betreff != null) {
		$sql .= " AND a.betreff LIKE '$betreff%' ";
	} elseif($problem != null) {
		$sql .= " AND a.problem LIKE '$problem%' ";
	} elseif($status != null) {
		$sql .= " AND s.status LIKE '$status%' ";
	} elseif($supportart != null) {
		$sql .= " AND sa.supportart LIKE '$supportart%' ";
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
