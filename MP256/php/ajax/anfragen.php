<?php
require_once '../../functions/ajax.func.php';
require_once '../../functions/database.func.php';

$status_id = $_GET['statusid'];
$update_id = $_GET['update'];
$team_mitarbeiter_id = $_GET['team_mitarbeiter'];
$mitarbeiter_id = $_GET['mitarbeiter'];
$user_id = $_GET['user'];

$connection = get_connection();

if(!empty($update_id)){
	working_anfrage($team_mitarbeiter_id, $update_id);
}
if(!empty($team_mitarbeiter_id)){
	echo get_anfragen_liste($team_mitarbeiter_id, $status_id);
} else if(!empty($mitarbeiter_id)){
	echo get_supporter_anfragen($mitarbeiter_id, $status_id);
} else if(!empty($user_id)){
	echo get_user_anfragen($user_id, $status_id);
}
mysql_close($connection);

?>