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
		Add New Section
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
	<script>
		function courseChanged(cno){
			if(cno == "NULL"){
				document.getElementById("section_year").disabled = true;
				document.getElementById("section_year").value = 0;
			}
			else{
				document.getElementById("section_year").min = 1;
				document.getElementById("section_year").value = 1;
				document.getElementById("section_year").max = document.getElementById("duration_"+cno).value;
				document.getElementById("section_year").disabled = false;
			}
		}
		function checkLimits(id){
			if(document.getElementById(id).value>document.getElementById(id).max){
				document.getElementById(id).value = document.getElementById(id).max;
			}
			else if(document.getElementById(id).value<document.getElementById(id).min && document.getElementById(id).value!=""){
				document.getElementById(id).value = document.getElementById(id).min;
			}
			else{
				//fine.
			}
		}
		function makepass(){
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			for( var i=0; i < 5; i++ )
			text += possible.charAt(Math.floor(Math.random() * possible.length));
			return text;
		}
		function checkboxClicked(){
			if(document.getElementById("checkbox_pw").checked){
				document.getElementById("section_pw").readOnly = true;
				document.getElementById("section_pw").value= makepass();
			}
			else{
				document.getElementById("section_pw").readOnly = false;
				document.getElementById("section_pw").value= "";
			}
		}
		function togglePw(){
			if(document.getElementById("toggle_pw").checked){
				document.getElementById("section_pw").type = 'text';
			}
			else{
				document.getElementById("section_pw").type = 'password';
			}
		}
	</script>
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
			if(!$_POST['section_name']) {
				//echo "<p>Please supply a valid course name.</p>";
				?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Section Name.
				</div>
				<?php
				$error++;
			}
		if(!$_POST['academic_session']){
			?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid academic session.
				</div>
			<?php
				$error++;
		}
		if(!$_POST['section_year']){
			?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Year.
				</div>
			<?php
				$error++;
		}
		if(!htmlspecialchars($_POST['section_pw'])){
			?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a Password.
				</div>
			<?php
				$error++;
		}
		if(strcmp($_POST['cno'],'NULL')==0){
			?>
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> Please enter a valid Course.
				</div>
			<?php
				$error++;
		}
			if($error == 0){ //insert into table.
				if($conn){ //echo "<h1>Successfully connected to DB</h1>";
					$sectionname = $_POST['section_name'];
					$courseno = $_POST['cno'];
					$academicsession = $_POST['academic_session'];
					$sectionyear = $_POST['section_year'];
					$sectionpw = $_POST['section_pw'];
					$sql = "SELECT * FROM section WHERE secname = '$sectionname' AND cno = $courseno AND year = $sectionyear AND session = $academicsession"; // no '' over $courseno as it is an integer
					//
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) > 0) { // section exists.
						$exists = true;
						$row = mysqli_fetch_assoc($result);
						?>
							<div class="alert alert-warning fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>Section Already Exists!</strong>
								<p>
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addModal">Add Teaching Faculty</button>
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#delModal">Delete Teaching Faculty</button>
								</p>
							</div>
						<?php
					}
					//
					else{ //section does not exist.
						$sql = "INSERT INTO section (secname, cno, year, session, password) VALUES('$sectionname', $courseno, $sectionyear, $academicsession, '$sectionpw')"; // no '' over $courseno as it is an integer
						if(mysqli_query($conn, $sql)){
							//echo "<p> Subject added successfully. </p>";
							?>
							<div class="alert alert-success fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<strong>New Section Added Successfully!</strong>
								<p>
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addModal">Add Teaching Faculty</button>
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#delModal">Delete Teaching Faculty</button>
								</p>
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
				}
				//mysqli_close($conn);
			}
		}
	?>
	<!-- Delete Modal Starts-->
	<script>
		function dtfdelClicked(btnname){
			var btnno = btnname.split("_")[2];
			var fno = document.getElementById("dtf_input_fno_"+btnno).value;
			var scode = document.getElementById("dtf_input_scode_"+btnno).value;
			var secname = <?php echo json_encode($sectionname); ?>;
			var courseno = <?php echo json_encode($courseno); ?>;
			var sectionyear = <?php echo json_encode($sectionyear); ?>;
			var academicsession = <?php echo json_encode($academicsession); ?>;
			//
			var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						if(xmlhttp.responseText == "Success"){
							document.getElementById('btnname').disabled = true;
						}
						document.getElementById('dtf_conveyer').innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "teachingfacultydel.php?d0=" + secname + "&d1=" + courseno + "&d2=" + sectionyear + "&d3=" + academicsession + "&d4=" + fno + "&d5=" + scode, true);
				xmlhttp.send();
			//
		}
	</script>
	<div id="delModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Delete Teaching Faculty</h4>
				</div>
				<div class="modal-body">
					<!-- MODAL BODY STARTS -->
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Department</th>
								<th>Faculty Name</th>
								<th>Subject</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i = -1;
								$sql = "SELECT * FROM teaches WHERE secname = '$sectionname' AND cno = $courseno AND year = $sectionyear AND session = $academicsession;";
								//$sql = "SELECT * FROM teaches";
								$result = mysqli_query($conn,$sql);
								if (mysqli_num_rows($result) > 0){
									while($row = mysqli_fetch_assoc($result)) {
										$i++;
										$dtf_fno = $row["fno"];
										// get fname from fno
											$sql = "SELECT * FROM faculty WHERE fno = $dtf_fno;";
											$result2 = mysqli_query($conn,$sql);
											if (mysqli_num_rows($result2) > 0){ //records have been selected to delete.
												while($row2 = mysqli_fetch_assoc($result2)) {
												$dtf_fname = $row2["fname"];
												$dtf_dptno = $row2["dno"];
												}
											}
										// get sname from scode
											$dtf_scode = $row["scode"];
											$sql = "SELECT * FROM subject WHERE scode = '$dtf_scode';";
											$result2 = mysqli_query($conn,$sql);
											if (mysqli_num_rows($result2) > 0){ //records have been selected to delete.
												while($row2 = mysqli_fetch_assoc($result2)) {
												$dtf_sname = $row2["sname"];
												}
											}
										// get dept name from dept no
											$sql = "SELECT * FROM department WHERE dno = $dtf_dptno;";
											$result2 = mysqli_query($conn,$sql);
											if (mysqli_num_rows($result2) > 0){ //records have been selected to delete.
												while($row2 = mysqli_fetch_assoc($result2)) {
												$dtf_dname = $row2["dname"];
												}
											}
										//
										echo"
											<input type='hidden' name='dtf_input_fno_".$i."' id='dtf_input_fno_".$i."' value='$dtf_fno' />
											<input type='hidden' name='dtf_input_scode_".$i."' id='dtf_input_scode_".$i."' value='$dtf_scode' />
											<tr>
												<td>$dtf_dname</td>
												<td>$dtf_fname</td>
												<td>$dtf_sname</td>
												<td><button class='btn btn-warning btn-block' id='dtf_delbutton_".$i."' onclick='dtfdelClicked(this.name)' name = 'dtf_delbutton_".$i."'> Delete </button></td>
											</tr>
										";
										//
									}
								}
							?>
						</tbody>
					</table>
						<div id="dtf_conveyer"></div>
						<?php if($i == -1) echo 'No teaching record found for this section!'; ?>
					<!-- MODAL BODY ENDS -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--Delete Modal Ends-->
	<script>
		function atfdepartmentChanged(){
			document.getElementById('atf_faculty').options.length = 0;
			document.getElementById('atf_subject').options.length = 0;
			if(document.getElementById("atf_department").value != "NULL"){
				var dno = document.getElementById("atf_department").value;
				document.getElementById('atf_conveyer').innerHTML = "";
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						//load select atf_faculty.
						//document.getElementById("atf_department")
						var facstring = xmlhttp.responseText.split("@")[0];
						var subjectstring = xmlhttp.responseText.split("@")[1];
						var facs = facstring.split(">");
						var select = document.getElementById('atf_faculty');
						for(var i=1;i<facs.length;i++){
							var fno = facs[i].split("~")[0];
							var fname = facs[i].split("~")[1];
							var opt = document.createElement('option');
							opt.value = fno;
							opt.innerHTML = fname;
							select.appendChild(opt);
						}
						var subs = subjectstring.split(">");
						select = document.getElementById('atf_subject');
						for(var i=1;i<subs.length;i++){
							document.getElementById('atf_addbutton').disabled = false;
							var scode = subs[i].split("~")[0];
							var sname = subs[i].split("~")[1];
							var opt = document.createElement('option');
							opt.value = scode;
							opt.innerHTML = sname;
							select.appendChild(opt);
						}
						if(subs.length<=1){
							//no faculties in the department selected.
							document.getElementById('atf_conveyer').innerHTML = document.getElementById('atf_conveyer').innerHTML + " No subjects in the selected department.";
							document.getElementById('atf_addbutton').disabled = true;
						}
						if(facs.length<=1){
							//no faculties in the department selected.
							document.getElementById('atf_conveyer').innerHTML = document.getElementById('atf_conveyer').innerHTML + " No faculties in the selected department.";
							document.getElementById('atf_addbutton').disabled = true;
						}
					}
				}
				xmlhttp.open("GET", "atfdeptchanged.php?dno=" + dno, true);
				xmlhttp.send();
			}
			else{ //NULL department selected.
				document.getElementById('atf_conveyer').innerHTML = "Please select a valid department.";
				document.getElementById('atf_addbutton').disabled = true;
			}
		}
		function atfaddClicked(){
			//var dpt = document.getElementById('atf_department').value;
			var fac = document.getElementById('atf_faculty').value;
			var sub = document.getElementById('atf_subject').value;
			var secname = <?php echo json_encode($sectionname); ?>;
			var courseno = <?php echo json_encode($courseno); ?>;
			var sectionyear = <?php echo json_encode($sectionyear); ?>;
			var academicsession = <?php echo json_encode($academicsession); ?>;
			//
			var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById('atf_conveyer').innerHTML = xmlhttp.responseText;
						if(xmlhttp.responseText == "Success"){
							document.getElementById('atf_conveyer').innerHTML = "Teaching Faculty Added Successfully!";
							document.getElementById('atf_addbutton').disabled = true;
						}
					}
				}
				xmlhttp.open("GET", "teachingfacultyadd.php?d0=" + secname + "&d1=" + courseno + "&d2=" + sectionyear + "&d3=" + academicsession + /*"&d4=" + dpt +*/ "&d5=" + fac + "&d6=" + sub, true);
				xmlhttp.send();
			//
		}
	</script>
	<!-- Add Modal Starts-->
	<div id="addModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Teaching Faculty</h4>
				</div>
				<div class="modal-body">
					<!-- MODAL BODY STARTS -->
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Department</th>
								<th>Faculty Name</th>
								<th>Subject</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select name='atf_department' id='atf_department' onchange="atfdepartmentChanged()" class="form-control">
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
									?>
									</select>
								</td>
								<td>
									<select name='atf_faculty' id='atf_faculty' class="form-control">
								</td>
								<td>
									<select name='atf_subject' id='atf_subject' class="form-control">
								</td>
								<td>
									<button class="btn btn-warning btn-block" id="atf_addbutton" onclick="atfaddClicked()" name = "atf_add" disabled> Add </button>
								</td>
							</tr>
									
						</tbody>
					</table>
					<div id="atf_conveyer"></div>
					<!-- MODAL BODY ENDS -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--Add Modal Ends-->
	
	<!-- Code to check if form has been submitted ends. -->
		<br>
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<span class="glyphicon glyphicon-plus"></span>  Add / Modify Section
			</div>
			<div class="panel-body">
				<form role="form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<div class="form-group">
					<label>Section Name</label>
					<input type='text' name='section_name' class="form-control" />
				</div>
				<div class="form-group">
					<label>Academic Session</label>
					<input type='number' min='2000' value='2015' max='3000' name='academic_session' onkeyup="checkLimits(this.id)" onchange="checkLimits(this.id)" id='academic_session' class="form-control" />
				</div>
				<div class="form-group">
					<label>Course</label>
					<select name='cno' class="form-control" onchange='courseChanged(this.value)'>
					
					<option class='form-control' value="NULL"></option>
					<!-- Categories from categories table from the database here-->
					<?php
					if($conn){ //check if connected to DB
						$conn = dblogin();
						$sql = "SELECT cno,cname,duration FROM course";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = mysqli_fetch_assoc($result)) {
								//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
								echo "<option class='form-control' value=\"".$row["cno"]."\">".$row["cname"]."</option>\n";
								echo "<input type='hidden' id=\"duration_".$row["cno"]."\" value=\"".$row['duration']."\"></input>";
							}
						}
					}
					//mysqli_close($conn);
					?>
					</select>
				</div>
				<div class="form-group">
					<label>Year</label>
					<input type='number' min='0' value='0' id='section_year' name='section_year' class="form-control" onkeyup="checkLimits(this.id)" onchange="checkLimits(this.id)" disabled />
				</div>
				<div class="form-group">
					<label>Password (for student feedback login) </label>
					<p>
						<input type='checkbox' id='checkbox_pw' onchange='checkboxClicked()' /> Generate a random password
					</p>
						<input type='password' id='section_pw' name='section_pw' class="form-control" />
					<p>
						<input type='checkbox' id='toggle_pw' onchange='togglePw()' /> Show password
					</p>
				</div>
				<input type = "submit" class="btn btn-warning btn-block" id="addbutton" name = "add" value = "Add/Modify"/>
				</form>
			</div>
		</div>
		</div>
	<div class="col-sm-4"></div>
	</div>
</body>
</html>