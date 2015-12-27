<?php
	function dblogin(){
			$servername = "localhost";
			$dbusername = "tester";
			$dbpassword = "test";
			$dbname = "feedbackform";
			$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
			return $conn;
		}
	$conn = dblogin();
	if(!$conn) $hodname = "";
	else if(strcmp($_GET['hodno'],"")==0) $hodname = "";
	else{
		$hodno = $_GET['hodno']; // $lotno = lot to be searched for in the database.
		$sql = "SELECT * FROM faculty WHERE fno=$hodno;";
		$result = mysqli_query($conn,$sql);
		$hodname = "";
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				$hodname = $row['fname'];
			}
		}
	}
	echo "$hodname";
?>