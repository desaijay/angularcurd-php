var app = angular.module("taskApp", []);

app.controller("taskController", function($scope, $http){
	$scope.clearForm = function(){
			$scope.name = "";
			$scope.description = "";
		}
	$scope.createTaskForm = function(){
		$scope.clearForm();
		$('#modal1').show();
		$("#modal-task-title").text("Create new Task");
		$("#btn-create-task").show();
		$('#btn-update-task').hide();
	}

	

	//get all the tasks
	$scope.getAll = function(){
    $http.get("libs/read_all_tasks.php").success(function(response){
        $scope.names = response.records;
    });
}
	

	$scope.deleteTask = function(id){
		 if(confirm("Are you sure ,you want to delete task no" +id+"?")){
		$http.post("libs/delete_task.php" ,{
			'id': id
		}).success(function(data, status, headers , config){
			Materialize.toast(data, 4000, "rounded");
			// refresh the list
           			 $scope.getAll();
		});
	}
}

	$scope.readTask = function(id){

		$('#modal-task-title').text("Update your task");
		$('#btn-update-task').show();
		$("#btn-create-task").hide();

		$http.post("libs/read_task.php",{
			'id':id
		}).success(function(data,status,headers,config){
			$scope.id = data[0]['id'];
			$scope.name = data[0]['name'];
			$scope.description = data[0]['description'];
			 $('#modal1').openModal();
		}).error(function(data,status,headers,config){
			Materialize.toast('Unable to retrieve record.', 4000,"rounded");
		});
	}

	$scope.createnewTask = function(){
		$http.post("libs/create_task.php", {
			"name":$scope.name,
			"description":$scope.description
		}).success(function(data, status, headers,config){
			console.log(data);
			Materialize.toast(data, 4000,"rounded");
			$scope.clearForm();
			 $('#modal1').closeModal();
			 $scope.getAll();
		});
	}

	$scope.updateTask = function(id){
		$http.post("libs/edit_task.php",{
			"id":$scope.id,
			"name": $scope.name,
			"description":$scope.description
		}).success(function(data,status,headers,config){
			  Materialize.toast(data, 4000,"rounded");
			  $('#modal1').closeModal();
			  $scope.clearForm();
			  $scope.getAll();
		});
	}

});