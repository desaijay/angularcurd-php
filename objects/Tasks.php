<?php

/**
* 
*/
class Tasks 
{
	private $conn; 
	private $tablename = "tasks";
	public  $id;
	public $name;
	public $description;
	public $created_at;
	public $updated_at;
	
	function __construct($db)
	{
		$this->conn = $db;
	}

	function createTask()
	{
		$insert_db_query = "INSERT INTO  ".$this->tablename."
				SET 
					name=:name, description=:description, created_at=:created_at, updated_at=:updated_at";
		
		$exec = $this->conn->prepare($insert_db_query);

		//set the inputs and sanitize it properly
		
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->description = htmlspecialchars(strip_tags($this->description));
		//bind the params
		//
		$exec->bindParam(":name", $this->name);
		$exec->bindParam(":description", $this->description);
		$exec->bindParam(":created_at", $this->created_at);
		$exec->bindParam(":updated_at", $this->updated_at);	
		
		if($exec->execute()){
			return true;
		}
		else{
			 echo "<pre>";
            print_r($exec->errorInfo());
        echo "</pre>";
 
		}
	}

	function updateTask()
	{
		$update_query = "UPDATE  ".$this->tablename."
					SET    
					       name = :name,
					       description = :description,
					       updated_at = :updated_at
					WHERE id = :id";
		
		$stmt_query           = $this->conn->prepare($update_query);
		$this->name          = htmlspecialchars(strip_tags($this->name));
		$this->description = htmlspecialchars(strip_tags($this->description));
		$this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

		//bind param 
		$stmt_query->bindParam(":id", $this->id);
		$stmt_query->bindParam(":name", $this->name);
		$stmt_query->bindParam(":description", $this->description);
		$stmt_query->bindParam(":updated_at", $this->updated_at);

		if($stmt_query->execute()){
			echo "Task was updated ";
		}
		else{
			echo "Error occured while updating the task";
		}

	}

	function singleTask()
	{	
		$read_single_task_query = "SELECT id, name, description FROM ".$this->tablename."
						WHERE id = ? LIMIT 0,1";
		
		$single_task_res = $this->conn->prepare($read_single_task_query);

			$single_task_res->bindParam(1, $this->id);
			$single_task_res->execute();

		 // get retrieved row
		    $row = $single_task_res->fetch(PDO::FETCH_ASSOC);
		     
		    // set values to object properties
		    $this->name = $row['name'];
		    $this->description = $row['description'];
	}

	function deleteTask(){
		$delete_query = "DELETE FROM ".$this->tablename."
					WHERE id= ? ";
		
		$delete_res = $this->conn->prepare($delete_query);

		 // 
		$delete_res->bindParam(1, $this->id);
		if($delete_res->execute()){
			return true;
		}else{
			return false;
		}
	}

	function readAllTasks(){
		$read_all_tasks = "SELECT id, name, description FROM ".$this->tablename." ORDER BY id DESC";
		$exec_query = $this->conn->prepare($read_all_tasks);
		$exec_query->execute();
		return $exec_query;
	}

	function export_CSV(){
		$csv_query = "SELECT id, name, description,created_at,updated_at FROM ".$this->tablename."  ";

		$query = $this->conn->prepare($csv_query);
		$query->execute();
		//this is how to get number of rows returned
		$num = $query->rowCount();

		$out = "ID,Name,Description,Created,Modified\n";

		if($num>0){
			while ($row = $query->fetch(PDO::FETCH_ASSOC)){
				extract($row);
				$out.="{$id},\"{$name}\",\"{$description}\",{$created_at},{$updated_at}\n";
			}
		}
		return $out;
	}

}