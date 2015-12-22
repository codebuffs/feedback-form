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
		Delete Subject
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
				//return null;
			}
			return $conn;
		}
	?>
	<!-- NAVBAR -->
		<nav class="navbar">
			<div class="contaner-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"><p class="text-warning"> ABCDEF COLLEGE </p></a>
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
			}
			else{ //connection successful!
			}
		?>
		<!-- Code to check if form has been submitted -->
	<?php
		$conn = dblogin();
		if(isset($_POST['delete_subject'])){
			$flag = 0; // maintains no of successful deletions.
			if($conn){
				$sql = "SELECT * FROM subject;";
				$result = mysqli_query($conn,$sql);
				if (mysqli_num_rows($result) > 0){ //records have been selected to delete.
					while($row = mysqli_fetch_assoc($result)) {
						/*$prevquantity = $row["quantity"];
						$prevstock = $row["current_stock"];*/
						$scode = $row["scode"];
						if(isset($_POST["scode_$scode"])){
							//$sql = "DELETE FROM lot WHERE lot_no=$lotno";
							$sql = "DELETE FROM subject WHERE scode='$scode'";//scode is a varnum.
							if(mysqli_query($conn, $sql))
							$flag++;
						}
					}
			}
			if($flag>0){
			?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Success! </strong><?php echo $flag;if($flag>1)echo " subjects";else echo " subject" ?> deleted successfully.
				</div>
			<?php
			}
			else{
				?>
					<div class="alert alert-warning">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Warning!</strong> No subject deleted from the database!
					</div>
				<?php
			}
		}
	}
	?>
	<!-- Code to check if form has been submitted ends. -->
		<div class="panel panel-warning">
      <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> All Subjects</div>
      <div class="panel-body">
		<!-- Panel Content Starts Here -->
	  <?php
		//$conn = dblogin();
		if($conn){
			$sql = "SELECT * FROM subject ORDER BY dno,scode";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0){
				?>
				<!-- Draw Table -->
				<form role="form" method="post" action='<?=$_SERVER['PHP_SELF']?>'>
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>Subject Code</th>
							<th>Subject Name</th>
							<th>Department</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
				<?php
				while($row = mysqli_fetch_assoc($result)) {
						$scode = $row["scode"];
						$sname = $row["sname"];
						$dno = $row["dno"];
						$sql = "SELECT dname FROM department WHERE dno = $dno"; //assuming dno is an integer in the database.
						$result2 = mysqli_query($conn,$sql);
						//
						if (mysqli_num_rows($result2) > 0){ //records have been selected to delete.
					while($row2 = mysqli_fetch_assoc($result2)) {
						$dname = $row2["dname"];
						}
						}
						//
						echo "<tr>
							<td>$scode</td>
							<td>$sname</td>
							<td>$dname</td>
							<td>
								<div class='checkbox'>
								<label><input type='checkbox' name='scode_$scode' value='scode_$scode'></label>
								</div>
							</td>
						</tr>";
				}
				?>
					</tbody>
				</table>
				<input type = "submit" class="btn btn-warning" name = "delete_subject" value="Delete Selected"/>
				</form>
				<?php
			}
			else{ //no products.
				echo "No Subjects found in the Database!";
			}
		}
	  ?>
	  <!-- Panel Content Ends Here -->
	  </div>
    </div>
	</div>
</body>
</html>