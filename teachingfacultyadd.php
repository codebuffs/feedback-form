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
	if(!$conn) $retsrt = "Could not connect to the database. Contact network administrator.";
	else if(strcmp($_GET['d0'],"")==0 || strcmp($_GET['d1'],"")==0 || strcmp($_GET['d2'],"")==0 || strcmp($_GET['d3'],"")==0 || /*strcmp($_GET['d4'],"")==0 ||*/ strcmp($_GET['d5'],"")==0 || strcmp($_GET['d6'],"")==0) $retstr = "Data not received properly";
	else{
		$sectionname = $_GET['d0'];
		$courseno = $_GET['d1'];
		$sectionyear = $_GET['d2'];
		$academicsession = $_GET['d3'];
		//$dpt = $_GET['d4'];
		$fac = $_GET['d5'];
		$sub = $_GET['d6'];
		$sql = "INSERT INTO teaches(secname, cno, year, session, fno, scode) VALUES ('$sectionname', $courseno, $sectionyear, $academicsession, $fac, '$sub')";
		if(mysqli_query($conn, $sql)){
			$retstr = "Success";
		}
		else{
			$retstr = "Failure";
		}
		//$retstr = "sectionname = ".$_GET['d0']." ,courseno = ".$_GET['d1']." ,sectionyear = ".$_GET['d2']." ,academicsession = ".$_GET['d3']." ,dpt = ".$_GET['d4']." ,fac = ".$_GET['d5']." ,sub = ".$_GET['d6'];
	}
	echo "$retstr";
?>