<!DOCTYPE html>
<html>
<head>
	<title>Todo App</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="assets/css/materialize/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
</head>
<body>
 <h3 class="center">Todo app</h3>
 <div class="container" ng-app="taskApp" ng-controller="taskController">
 <div id="modal1" class="modal">
 <div class="modal-content">
 <h4 id="modal-task-title">Create New Task</h4>
 <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Name of the task" ng-model="name" type="text" class="validate">
          <label for="fname">Name</label>
        </div>
        
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input type="text"  placeholder="Define your task" ng-model="description" class="validate">
          <label for="description">Description</label>
        </div>
      </div>
       <div class="input-field col s12">
                <a id="btn-create-task" class="waves-effect waves-light blue btn margin-bottom-1em" ng-click="createnewTask()"><i class="material-icons left">add</i>Create</a>
 
                <a id="btn-update-task" class="waves-effect waves-light  btn margin-bottom-1em" ng-click="updateTask()"><i class="material-icons left">edit</i>Update</a>
 
                <a class="modal-action modal-close waves-effect waves-light btn red margin-bottom-1em"><i class="material-icons left">close</i>Close</a>
            </div>
    </form>
  </div>
  </div>
        </div>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
   <a class="btn-floating btn-large modal-trigger waves-effect waves-light blue btn tooltipped" href="#modal1" data-position="left" data-tooltip="Create task" ng-click="createTaskForm()">
 	  <i class="material-icons">add</i>
   </a>
  </div> <!-- used for searching the current list -->
  <div class="fixed-action-btn horizontal" style="bottom: 110px; right: 24px;">
    <a class="btn-floating btn-large red">
      <i class="large material-icons">file_download</i>
    </a>
    <ul>
      <li><a class="btn-floating green tooltipped" data-delay="50" data-position="left" data-tooltip="Export in CSV file" href="libs/export_csv.php"><i class="material-icons">publish</i></a></li>
      <li><a class="btn-floating blue tooltipped" data-delay="50" data-position="top" data-tooltip="Export in Excel file" href="libs/export_xls.php"><i class="material-icons">attach_file</i></a></li>
    </ul>
  </div> <!-- used for searching the current list -->
<input type="text" ng-model="search" class="form-control" placeholder="Search task..." />
      <table class="striped bordered">
      <thead>
         <tr><th>Id</th><th>name</th><th>Description</th><th>Created At</th></tr>
      </thead>
      <tbody ng-init = "getAll()">
         <tr ng-repeat="d in names | filter :search">
         	<td>{{d.id}}</td>
         	<td>{{d.name}}</td>
         	<td>{{d.description}}</td>
         	<td><a class="waves-effect red waves-light btn" ng-click="deleteTask(d.id)"><i class="material-icons left">delete</i>Delete</a>
	</td>
	<td><a class="waves-effect waves-light btn" ng-click="readTask(d.id)"><i class="material-icons left">mode_edit</i>Edit</a>
</td></tr>
      </tbody>
      </table>
</div>
 <!-- jQuery is required by Materialize to function -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/angular.min.js"></script>
  <script type="text/javascript" src="assets/css/materialize/js/materialize.min.js"></script>
  <script type="text/javascript" src="assets/js/app.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
  </script>
</body>
</html>