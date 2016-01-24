<?php
	// Start the session
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
	/*if(isset($_POST['submit'])){
		$_SESSION["username"] = $_POST["username"];
		$_SESSION["type"] = $_POST['type'];
		//$cookie_name = "username";
		//$cookie_value = $_POST['username'];
		//setcookie($cookie_name, $cookie_value, time() + (86400*30) /*1 month, "/");
		//$cookie_name = "type";
		//$cookie_value = $_POST['type'];
		//setcookie($cookie_name, $cookie_value, time() + (86400*30) /*1 month, "/");
	}*/
	
	function redirect($url)
	{
    header('Location: '.$url);
    exit();
	}
	//redirect('http://example.com'); //redirects to example.com and exits the script
?>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>

    </script>
	<link rel="stylesheet" href="universal.css">
    <link rel="stylesheet" href="homestyle.css">
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
	<br>
	<div class="container-fluid">
		<div class="alert alert-warning">
			<p><strong>Please Sign In to Continue</strong></p>
		</div>
		<!---->
		
		<?php
			$error=0;
			//check if form submitted.
			if(isset($_POST['adminsubmit']) || isset($_POST['studentsubmit']) ) {
				//means THIS FORM IS A SUBMITTED FORM!";
				//Error checking
				/*if(strcmp($_POST['usertype'],"student")==0){
					$tabvar = 1;
				}
				else $tabvar = 2;*/
				if(!$_POST['username']) {
					//echo "<p>Please supply your username.</p>";
					?>
						<!--!-!-!-!-!-HTML Code Starts here-!-!-!-!-!-!-->
						<div class="alert alert-danger fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Error!</strong> Please enter a username.
						</div>
						<!-- HTML Code ends here -->
					<?php
					$error++;
				}
				if(!$_POST['password']) {
					//echo "<p>Please supply your password.</p>";
					?>
						<!--!-!-!-!-!-HTML Code Starts here-!-!-!-!-!-!-->
						<div class="alert alert-danger fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Error!</strong> Please enter a password.
						</div>
						<!-- HTML Code ends here -->
					<?php
					$error++;
				}
			//No errors, process
			if($error==0) {
				$found = false;
				//Process your form.
				/*$servername = "localhost";
				$dbusername = "test";
				$dbpassword = "tester";
				$dbname = "inventorymanagement";
				$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
				if (!$conn) {
					echo "<h1>Couldn't connect to DB</h1>";
				}*/
				$conn = dblogin();
				//echo "<h1>Successfully connected to DB</h1>";
					$username = $_POST['username'];
					$password = $_POST['password'];
					//
					if(isset($_POST['adminsubmit'])){
						$type = 'admin';
						$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password';";// AND type='$type'";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) { // admin exists. login.
							$found = true;
							$row = mysqli_fetch_assoc($result);
							$name = $row['name'];
							$_SESSION["username"] = $username;
							$_SESSION["type"] = $type;
							$_SESSION["name"] = $name;
							redirect("welcome.php");
						}
					}
					//
					if(isset($_POST['studentsubmit'])){
						$type = 'student';
						$sectionarr = explode("-",$username);
						$sql = "SELECT * FROM section WHERE session=".$sectionarr[0]." AND year=".$sectionarr[1]." AND cno=".$sectionarr[2]." AND secname='".$sectionarr[3]."' AND password='$password';";// AND type='$type'";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) { // admin exists. login.
							$found = true;
							$_SESSION["username"] = $username;
							$_SESSION["type"] = $type;
							$_SESSION["session"] = $sectionarr[0];
							$_SESSION["year"] = $sectionarr[1];
							$_SESSION["cno"] = $sectionarr[2];
							$_SESSION["secname"] = $sectionarr[3];
							redirect("welcome.php");
						}
					}
					//$type = $_POST['type'];
		/*$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password';";// AND type='$type'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			//echo "<h1>Welcome! User exists!</h1>";
			//redirect...
			$row = mysqli_fetch_assoc($result);
			$eno = $row['eno'];
			//echo "EMPLOYEE NO: ".$eno;
			$sql = "SELECT * from employee WHERE eno = $eno";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$name = $row['name'];
			if(strcasecmp($type,$row['designation'])==0){
				$found = true;
				$_SESSION["username"] = $username;
				$_SESSION["type"] = $type;
				$_SESSION["name"] = $name;
				redirect("welcome.php");
			}
			}
		}*/
		if($found==false){
			//echo "<h1>User does not exist. Please try again.</h1>";
			?>
				<!--!-!-!-!-!-HTML Code Starts here-!-!-!-!-!-!-->
				<div class="alert alert-danger fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> Invalid Login credentials. Please retry.
				</div>
				<!-- HTML Code ends here -->
			<?php
		}
	}
	}
	//Finish processing form.
	//echo "<p> No errors! </p>";
    //Display confirmation page
    //echo "<p>Thank you for your submission.</p>\n";
    //Require or include any page footer you might have
    //here as well so the style of your page isn't broken.
    //Then exit the script.
    //exit;
	?>
		
		<!---->
		<div class="col-sm-4 col-md-4">
		</div>
		<div class="col-sm-4 col-md-4">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<p><span class="glyphicon glyphicon-user"></span>  Login</p>
				</div>
				<div class="panel-body">
					<form role="form" action='<?=$_SERVER['PHP_SELF']?>' method="post">
					<div class="form-group">
					</div>
						<div class="content">
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" class="form-control" name="username" type="text" autocomplete="off" />
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" class="form-control" name="password" type="password">
								</div>
								<br>
								<div class="form-group">
									<div class="btn-group btn-group-justified">
										<div class="btn-group">
											<input type = "submit" class="btn btn-warning btn-block" name = "adminsubmit" value="Admin"/>
										</div>
										<div class="btn-group">
											<input type = "submit" class="btn btn-warning btn-block" name = "studentsubmit" value="Student"/>
										</div>
									</div>
								</div>
						</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4 col-md-4">
		</div>
	</div>
</body>
</html>