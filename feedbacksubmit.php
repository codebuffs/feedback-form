<?php
	// Start the session
	session_start();
?>
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
	$session = $_SESSION["session"];
	$year = $_SESSION["year"];
	$cno = $_SESSION["cno"];
	$secname = $_SESSION["secname"];
	$count = $_POST["count"];
	for($i=1;$i<=$count;$i++){
		$fno = $_POST["fno-$i"];
		$scode = $_POST["scode-$i"];
		for($qcount=0;$qcount<10;$qcount++){
			if(isset($_POST["q-$qcount-facno-$fno"])){
				$rating = $_POST["q-$qcount-facno-$fno"];
				$sql = "INSERT INTO feedback (session, year, cno, secname, fno, scode, qno, rating) VALUES ($session, $year, $cno, '$secname', $fno, '$scode', $qcount, $rating)";
				if (mysqli_query($conn, $sql)) {
					echo "Rating added successfully.<br>";
				} else {
					echo "Error.<br>";
				}
			}
		}
	}
	$_SESSION["username"] = null;
?>