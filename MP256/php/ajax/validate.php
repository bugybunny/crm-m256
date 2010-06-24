<?php
require_once '../../functions/validation.func.php';
require_once '../../functions/database.func.php';

$value = $_GET['value'];
$type = $_GET['type'];
$compare_value = !empty($_GET['compare_value']) ? $_GET['compare_value'] : "";

$connection = get_connection();
echo validate($type, $value, $compare_value) ? "1" : "0";
mysql_close($connection);
?>