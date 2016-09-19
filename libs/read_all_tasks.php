<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__. "/objects/Tasks.php");
require_once(__ROOT__."/config/Db.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// initital db object

$database = new Db;
$db = $database->getDbconnection();

//initialize tasks object

$task = new Tasks($db);

$query = $task->readAllTasks();
$no = $query->rowCount();

$data = "";
if($no > 0){
	$x = 1;
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$data .='{';
		$data .=' "id": " ' .$id.' ", ';
		$data .=' "name": " ' .$name.' ", ';
		$data .=' "description": " ' .html_entity_decode($description).' " ';
		$data .='}';
		$data .= $x<$no ? ',' : ''; $x++;  
	}
}

//json format output data
echo '{"records":['.$data.']}';