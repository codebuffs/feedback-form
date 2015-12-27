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
		Add New Faculty
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
	<?php include('navbar.php'); ?>
		<?php
			$conn = dblogin();
			if (!$conn) { //could not connect to db.
			}
			else{ //connection successful!
			}
		?>
		<!-- Code to check if form has been submitted -->
	<?php
		$error = 0;
		if(isset($_POST['add'])) {
			if(!$_POST['faculty_name']) {
				//echo "<p>Please supply a valid faculty name.</p>";
				?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Faculty Name.
				</div>
				<?php
				$error++;
			}
		if(!$_POST['faculty_no']){
			?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Faculty Number.
				</div>
			<?php
				$error++;
		}
		/*if(strcmp($_POST['department'],'blank')==0){
			?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Department.
				</div>
			<?php
				$error++;
		}*/ // Faculty can belong to no department, hence, removed this check.
			if($error == 0){ //insert into table.
				if($conn){ //echo "<h1>Successfully connected to DB</h1>";
					$facultyname = $_POST['faculty_name'];
					$facultyno = $_POST['faculty_no'];
					$departmentno = $_POST['department'];
					$sql = "INSERT INTO faculty (fname, fno, dno) VALUES('$facultyname', $facultyno, $departmentno)"; // no '' over $facultyno as it is an integer
					if(mysqli_query($conn, $sql)){
						//echo "<p> Subject added successfully. </p>";
						?>
						<div class="alert alert-success fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>New Faculty Added Successfully!</strong>
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
				<span class="glyphicon glyphicon-plus"></span>  Add New Faculty
			</div>
			<div class="panel-body">
				<form role="form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<div class="form-group">
					<label>Faculty Name</label>
					<input type='text' name='faculty_name' class="form-control" />
				</div>
				<div class="form-group">
					<label>Faculty Number</label>
					<input type='text' name='faculty_no' class="form-control" />
				</div>
				<div class="form-group">
					<label>Department</label>
					<select name='department' class="form-control">
					<option class='form-control' value="NULL"></option>
					<!-- Categories from categories table from the database here-->
					<?php
					if($conn){ //check if connected to DB
						$conn = dblogin();
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
				<input type = "submit" class="btn btn-warning btn-block" name = "add" value = "Add Faculty" />
				</form>
			</div>
		</div>
		</div>
	<div class="col-sm-4"></div>
	</div>
</body>
</html>