<?php 
ini_set("display_errors", "1");
error_reporting(E_ALL);
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__. "/objects/Tasks.php");
require_once(__ROOT__."/config/Db.php");

// initital db object
$database = new Db;
$db = $database->getDbconnection();

//initialize tasks object
$task = new Tasks($db);

$data = json_decode(file_get_contents("php://input")); 

$task->id = $data->id;

if($task->deleteTask()){
	echo "Task was deleted";
}
// if unable to delete the task
else{
    echo "Unable to delete object.";
}
?>


