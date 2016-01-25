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
	/*if(strcmp($_SESSION["type"],'student')==0){
		//redirect to feedback form page.
	}*/
?>
<head>
	<meta charset="utf-8">
	<title>
		Feedback Form
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
	<?php
		$conn = dblogin();
		//retrieve teaching faculty info here.//
		$session = $_SESSION["session"];
		$year = $_SESSION["year"];
		$cno = $_SESSION["cno"];
		$secname = $_SESSION["secname"];
		$sql = "SELECT * FROM teaches WHERE session=$session AND year=$year AND cno=$cno AND secname='$secname'";// AND type='$type'";
		$result = mysqli_query($conn, $sql);
		$count = 0;
		if (mysqli_num_rows($result) > 0) { // faculties teach this section.
			while($row = mysqli_fetch_assoc($result)) {
				$count++;
				$fno[$count] = $row["fno"];
				$scode[$count] = $row["scode"];
				$fnovar = $fno[$count];
				$sql = "SELECT * FROM faculty WHERE fno=$fnovar";// AND type='$type'";
				$result2 = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result2) > 0) {
					while($row2 = mysqli_fetch_assoc($result2)) {
						$fname[$count] = $row2["fname"];
					}
				}
				$scodevar = $scode[$count];
				$sql = "SELECT * FROM subject WHERE scode='$scodevar'";// AND type='$type'";
				$result2 = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result2) > 0) {
					while($row2 = mysqli_fetch_assoc($result2)) {
						$sname[$count] = $row2["sname"];
					}
				}
			}
		}
		//
	?>
	<div class="panel panel-warning">
			<!--<div class="panel-heading">
				<span class="glyphicon glyphicon-plus"></span> Heading
			</div>-->
			<div class="panel-body">
				<form role="form" method="post" action="feedbacksubmit.php">
				<input type="hidden" name="count" value="<?php echo $count; ?>" />
				<?php
					for($i=1;$i<=$count;$i++){
						$fnovar = $fno[$i];
						$scodevar = $scode[$i];
						echo "<input type='hidden' name='fno-$i' value='$fnovar' />";
						echo "<input type='hidden' name='scode-$i' value='$scodevar' />";
					}
				?>
				<!-- Collapse Starts -->
				<div class="panel-group" id="accordion">
				<?php
					if($count==0){
						?>
							<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>No faculty teaches this section. Contact the admin.</strong>
							</div>
						<?php
						exit();
					}
											//all questions defined here.
											$ques[0] = "Clarity in understanding of the topic taught by the teacher?";
											$ques[1] = "Use of  teaching aids and  Practical /real time examples";
											$ques[2] = "Whether teacher integrates the Course with Model Questions & University exam papers";
											$ques[3] = "Effectiveness of teacher in terms of comm. skill and black board presentation";
											$ques[4] = "Teacher's response to students' queries";
											$ques[5] = "Teacher helps with notes / Text book / e-resources etc;";
											$ques[6] = "Accessibility of teacher beyond normal class hours to solve individual problems";
											$ques[7] = "Teacher shares the answers of Class / Sessional Test / PUT after conducting each test";
											$ques[8] = "Punctuality of teacher and discipline in the class room";
											$ques[9] = "Motivates students and inspires them for ethical conduct";
											//
					for($i=1;$i<=$count;$i++){
					?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>">
										<table class="table table-bordered">
										<thead>
										<tr>
										<th><?php echo $fname[$i]; ?></th>
										<th><?php echo $sname[$i]; ?></th>
										</tr>
										</thead>
										</table>
									</a>
								</h4>
							</div>
							<div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
										  <tr>
											<th>SNo</th>
											<th>Field</th>
											<th>Feedback</th>
										  </tr>
										</thead>
										<tbody>
										<?php
											for($qcount=0;$qcount<10;$qcount++){
											?>
										  <tr>
											<td><?php echo ($qcount+1); ?>.</td>
											<td><?php echo $ques[$qcount]; ?></td>
											<td> <input type="radio" name="q-<?php echo $qcount; ?>-facno-<?php echo $fno[$i]; ?>" value="1" /> 1 <input type="radio" name="q-<?php echo $qcount; ?>-facno-<?php echo $fno[$i]; ?>" value="2" /> 2 <input type="radio" name="q-<?php echo $qcount; ?>-facno-<?php echo $fno[$i]; ?>" value="3" /> 3 <input type="radio" name="q-<?php echo $qcount; ?>-facno-<?php echo $fno[$i]; ?>" value="4" />4 <input type="radio" name="q-<?php echo $qcount; ?>-facno-<?php echo $fno[$i]; ?>" value="5" />5</td>
										  </tr>
										  <?php
											}
										  ?>
										</tbody>
									  </table>
								</div>
							</div>
						</div>
					<?php
					}
				  ?>
			</div>
				<!-- Collapse Ends -->
				<input type = "submit" class="btn btn-warning btn-block" name = "add" value = "Submit Form" />
				</form>
		</div>
	</div>
</body>
</html>