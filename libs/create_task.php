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

$data = json_decode(file_get_contents("php://input")); 

$task->name = $data->name;
$task->description = $data->description;
$task->created_at = date("Y-m-d H:i:s");
$task->updated_at = date("Y-m-d H:i:s");

if($task->createTask())
{
	echo "Task was created successfully";
}
else
{
	echo "Unable to create the task";

}
?>