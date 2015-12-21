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
		Add New Subject
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
					<div class="alert alert-warning">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error! </strong> Could not connect to the database.
					</div>
				<?php
				return null;
			}
			return $conn;
		}
	?>
	<!-- NAVBAR COMES HERE -->
	<nav class="navbar navbar-inverse">
		<div class="contaner-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><p style="color:#804000;"> ABCDEF COLLEGE </p></a>
			</div>
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
			if (!$conn) {
				//echo "<h1>Couldn't connect to DB</h1>";
				?>
				<!--!-!-!-!-!-HTML Code Starts here-!-!-!-!-!-!-->
					<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Unable to connect to Database. Please contact the network administrator!</strong>
					</div>
				<?php
			}
			else{ //connection successful!
			}
		?>
		<!-- Code to check if form has been submitted -->
	<?php
		$error = 0;
		if(isset($_POST['add'])) {
			if(!$_POST['subject_name']) {
				//echo "<p>Please supply a valid subject name.</p>";
				?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Subject Name.
				</div>
				<?php
				$error++;
			}
		if(!$_POST['subject_code']){
			?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Subject Code.
				</div>
			<?php
				$error++;
		}
		if(strcmp($_POST['department'],'blank')==0){
			?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Department.
				</div>
			<?php
				$error++;
		}
			if($error == 0){ //insert into table.
				if($conn){ //echo "<h1>Successfully connected to DB</h1>";
					$subjectname = $_POST['subject_name'];
					$subjectcode = $_POST['subject_code'];
					$departmentno = $_POST['department'];
					$sql = "INSERT INTO subject (sname, scode, dno) VALUES('$subjectname', '$subjectcode', $departmentno)";
					if(mysqli_query($conn, $sql)){
						//echo "<p> Subject added successfully. </p>";
						?>
						<div class="alert alert-success fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>New Subject Added Successfully!</strong>
						</div>
						<?php
					}
					else{
						//echo "<p> Product could not be added. Try again. </p>";
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
				<!--Product Name
				Product Price
				Product Category-->
				<div class="form-group">
					<label>Subject Name</label>
					<input type='text' name='subject_name' class="form-control" />
				</div>
				<div class="form-group">
					<label>Subject Code</label>
					<input type='text' name='subject_code' class="form-control" />
				</div>
				<div class="form-group">
					<label>Department</label>
					<select name='department' class="form-control">
					<option class='form-control' value="blank"></option>
					<!-- Categories from categories table from the database here-->
					<?php
					if($conn){ //check if connected to DB
						$sql = "SELECT dno,dname FROM department";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = mysqli_fetch_assoc($result)) {
								//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
								echo "<option class='form-control' value=\"".$row["dno"]."\">".$row["dname"]."</option>\n";
							}
						}
					}
					mysqli_close($conn);
					?>
					</select>
				</div>
				<!--Categories loaded in the select element-->
				<input type = "submit" class="btn btn-warning btn-block" name = "add" value = "Add Subject" />
				</form>
			</div>
		</div>
		</div>
	<div class="col-sm-4"></div>
	</div>
</body>
</html>