<?php
require_once '../../functions/database.func.php';
require_once '../../functions/ajax.func.php';

$searchtype = isset($_GET['searchtype']) ? mysql_escape_string($_GET['searchtype']) : "";
$searchvalue = isset($_GET['value']) ? mysql_escape_string($_GET['value']) : "";

$connection = get_connection();
echo get_anfrageliste($searchtype, $searchvalue);

mysql_close($connection);
?>