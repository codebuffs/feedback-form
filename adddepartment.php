<?php
	// Start the session
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<html>
<?php
	//CODE TO CHECK IF USER LOGGED IN OR NOT.
	if($_SESSION["username"]==null){
		header('Location: '."home.php");
	}
	if(strcmp($_SESSION["type"],'student')==0){
		//redirect to feedback form page.
	}
?>
<head>
	<meta charset="utf-8">
	<title>
		Add New Department
	</title>
	<html lang="en">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="universal.css">
	<link rel="stylesheet" href="addstyle.css">
</head>
<body>
	<div class="contaner-fluid">
	<?php
		function dblogin(){
			$servername = "localhost";
			$dbusername = "tester";
			$dbpassword = "test";
			$dbname = "feedbackform";
			$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
			if(!$conn){
				?>
					<!--!-!-!-!-!-HTML Code Starts here-!-!-!-!-!-!-->
					<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Unable to connect to Database. Please contact the network administrator!</strong>
					</div>
				<?php
				exit();
			}
			return $conn;
		}
	?>
	<!-- NAVBAR COMES HERE -->
	<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><p style="color:#804000;"> ABCDEF COLLEGE </p></a>
			</div>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><p style="color:#cc8800;"><span class="glyphicon glyphicon-plus" ></span> Add <span class="caret"></span></p></a>
				<ul class="dropdown-menu">
					<li><a href="#"> Add Subject</p></a></li>
					<li><a href="#"> Add Faculty</a></li>
					<li><a href="#"> Add Section</a></li>
					<li><a href="#"> Add Course</a></li>
					<li><a href="#"> Add Department</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><p style="color: #cc8800;"><span class="glyphicon glyphicon-minus"></span> Delete <span class="caret"></span></p></a>
				<ul class="dropdown-menu">
					<li><a href="#"> Delete Subject</a></li>
					<li><a href="#"> Delete Faculty</a></li>
					<li><a href="#"> Delete Section</a></li>
					<li><a href="#"> Delete Course</a></li>
					<li><a href="#"> Delete Department</a></li>
				</ul>
			</li>
			<li><a href="#"><p style="color:#cc8800;"><span class="glyphicon glyphicon-font"></span>iwaii</p></a></li>
			<li><a href="#"><p style="color:#cc8800;"><span class="glyphicon glyphicon-bold"></span>laba</p></a></li>
		</ul>
	</nav>
		<?php
			$conn = dblogin();
			if (!$conn) { //could not connect to db.
			}
			else{ //connection successful!
			}
		?>
		
	<script>
		function sethodname(hodname){
			var div = document.getElementById("hod_name");
			if(hodname == ""){
				div.style.color = "Red";
				div.innerHTML = "<p>No faculty found!</p>";
				document.getElementById("submitbutton").disabled = true;
			}
			else if(hodname == "~"){
				div.style.color = "Black";
				div.innerHTML = "<p> No HOD Selected </p>";
				document.getElementById("submitbutton").disabled = false;
			}
			else{
				div.style.color = "Black";
				div.innerHTML = "<p>"+hodname+"</p>";
				document.getElementById("submitbutton").disabled = false;
			}
		}
		function hodChanged(){
		var hodno = document.getElementById("hod_no").value; // change value of hidden field to the value of the visible field.
		if(hodno == "") sethodname("~");
		else{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					sethodname(xmlhttp.responseText);
				}
			}
			xmlhttp.open("GET", "hodchanged.php?hodno=" + hodno, true);
			xmlhttp.send();
		}
	}
	</script>
		<!-- Code to check if form has been submitted -->
	<?php
		$error = 0;
		if(isset($_POST['add'])) {
			if(!$_POST['dept_name']) {
				//echo "<p>Please supply a valid Dept name.</p>";
				?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Department Name.
				</div>
				<?php
				$error++;
			}
		if(!$_POST['dept_no']){
			?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Department Number.
				</div>
			<?php
				$error++;
		}
			if($error == 0){ //insert into table.
				if($conn){ //echo "<h1>Successfully connected to DB</h1>";
					$deptname = $_POST['dept_name'];
					$deptno = $_POST['dept_no'];
					$hodno = $_POST['hod_no'];
					if(strcmp($hodno,"")!=0){
						$sql = "INSERT INTO department (dname, dno, hodno) VALUES('$deptname', $deptno, $hodno)";
					}
					else{
						$sql = "INSERT INTO department (dname, dno, hodno) VALUES('$deptname', $deptno, NULL)";
					}
					if(mysqli_query($conn, $sql)){
						//echo "<p> Dept added successfully. </p>";
						?>
						<div class="alert alert-success fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>New Department Added Successfully!</strong>
						</div>
						<?php
					}
					else{
						//echo "<p> Dept could not be added. Try again. </p>";
						?>
							<div class="alert alert-danger fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Something went wrong!</strong> Please contact the network administrator.
							</div>
						<?php
					}
				}
				mysqli_close($conn);
			}
		}
	?>
	<!-- Code to check if form has been submitted ends. -->
		<br>
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<span class="glyphicon glyphicon-plus"></span>  Add New Subject
			</div>
			<div class="panel-body">
				<form role="form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<div class="form-group">
					<label>Department Name</label>
					<input type='text' name='dept_name' class="form-control" />
				</div>
				<div class="form-group">
					<label>Department Number</label>
					<input type='text' name='dept_no' class="form-control" />
				</div>
				<div class="form-group">
					<div class="col-sm-6">
						<label>HOD Faculty Number</label>
						<input type='text' name='hod_no' id='hod_no' class="form-control"/>
					</div>
					<div id='hod_name' class="col-sm-6">
						<p> No HOD Selected </p>
					</div>
						<button type='button' class="btn btn-default" name="update_hod" id='update_hod' onclick="hodChanged()">Update</button>
					<!--<input type='text' name='hod_name' id='hod_name' class="form-control" disabled/>-->
				</div>
				<!--Categories loaded in the select element-->
				<input type = "submit" class="btn btn-warning btn-block" id="submitbutton" name = "add" value = "Add Department"/>
				</form>
			</div>
		</div>
		</div>
	<div class="col-sm-4"></div>
	</div>
</body>
</html>