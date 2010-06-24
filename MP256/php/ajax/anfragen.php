<?php
require_once '../../functions/ajax.func.php';
require_once '../../functions/database.func.php';

$status_id = $_GET['statusid'];
$update_id = $_GET['update'];
$mitarbeiter_id = $_GET['mitarbeiter'];

$connection = get_connection();

if(!empty($update_id)){
	working_anfrage($mitarbeiter_id, $update_id);
}
echo get_anfragen_liste($mitarbeiter_id, $status_id);
mysql_close($connection);

?>