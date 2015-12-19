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
		Welcome
	</title>
	<html lang="en">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="universal.css">
	<link rel="stylesheet" href="welcomestyle.css">
</head>
<body>
	<?php
		function dblogin(){
			$servername = "localhost";
			$dbusername = "test";
			$dbpassword = "tester";
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
	<div class="container-fluid">
	<!-- NAVBAR WILL COME HERE -->
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
		<div class="panel panel-primary">
		<div class="panel-body">
			<?php
					//$username = htmlspecialchars($_SESSION['username']);
					$name = $_SESSION["name"];
					$type = htmlspecialchars($_SESSION['type']);
					echo "<p>Welcome, $name! Have a nice day!</p><p>Choose an option to continue. </p>";
			?>
		</div>
		</div>
		</div>
</body>
</html>