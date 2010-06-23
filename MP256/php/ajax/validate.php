<?php
require_once '../../functions/validation.func.php';
require_once '../../functions/database.func.php';

$value = $_GET['value'];
$type = $_GET['type'];

$connection = get_connection();
echo validate($type, $value) ? "1" : "0";
mysql_close($connection);
?>