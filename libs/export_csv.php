<?php 
// include database and object files
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__. "/objects/Tasks.php");
require_once(__ROOT__."/config/Db.php");

// instantiate database and task object
$database = new Db;
$db = $database->getDbconnection();

$task = new Tasks($db);

header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=all_tasks_" . date('Y-m-d_H-i-s') . ".csv");
echo $task->export_CSV();
?>