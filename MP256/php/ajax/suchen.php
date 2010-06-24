<?php
require_once '../../functions/database.func.php';
require_once '../../functions/ajax.func.php';

$betreff = isset($_REQUEST['betreff']) ? mysql_escape_string($_GET['betreff']) : "";
$kunde = isset($_REQUEST['kunde']) ? mysql_escape_string($_GET['kunde']) : "";
$supporter = isset($_REQUEST['supporter']) ? mysql_escape_string($_GET['supporter']) : "";
$supportart = isset($_REQUEST['supportart']) ? mysql_escape_string($_GET['supportart']) : "";
$status = isset($_REQUEST['status']) ? mysql_escape_string($_GET['status']) : "";

$connection = get_connection();
echo get_anfrageliste($betreff, $kunde, $supporter, $supportart, $status);

mysql_close($connection);
?>