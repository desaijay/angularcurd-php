<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__. "/objects/Tasks.php");
require_once(__ROOT__."/config/Db.php");

//initialize the database object
$database = new Db;
$db = $database->getDbconnection();

//initialize the tasks object
$task = new Tasks($db);


header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=all_tasks_" . date('Y-m-d_H-i-s') . ".xls");

echo $task->export_CSV();

?>