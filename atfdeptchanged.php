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
	if(!$conn) $faculty = "@";
	else if(strcmp($_GET['dno'],"")==0) $faculty = "@";
	else{
		$dno = $_GET['dno']; // $lotno = lot to be searched for in the database.
		$sql = "SELECT * FROM faculty WHERE dno=$dno;";
		$result = mysqli_query($conn,$sql);
		$faculty = "";
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				//$hodname = $row['fname'];
				$faculty = $faculty.">".$row['fno']."~".$row['fname'];
			}
		}
		$faculty = $faculty."@";
		$sql = "SELECT * FROM subject WHERE dno=$dno;";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				//$hodname = $row['fname'];
				$faculty = $faculty.">".$row['scode']."~".$row['sname'];
			}
		}
	}
	echo "$faculty";
?>