<?php
include 'connection.php';
session_start();

if(isset($_GET['cid']) && isset($_GET['testid'])){
	if(isset($_SESSION['startQuizCid'])){
		header("Location:quiz.php");	
	}

	$cid=$_GET['cid'];
	$testid=$_GET['testid'];
	$sql=mysqli_query($db,"select * from quiz_details where cid=$cid and testid=$testid");
	if($row=mysqli_fetch_array($sql)){
		
		date_default_timezone_set('Asia/Kolkata');
		$now = time();
		$startTime = date('Y-m-d H:i:s', $now);
		$duration=$row['duration_minutes'];
		$end = $now + ($duration * 60);
		$endTime = date('Y-m-d H:i:s', $end);
		$_SESSION['quizEndTime']=$endTime;
		$_SESSION['quizstartTime']=$startTime;
		// echo "<script>document.write(localStorage.setItem('starttime','".$startTime."'))</script>";
		$_SESSION['startQuizCid']=$row['cid'];
		$_SESSION['testid']=$row['testid'];
		$_SESSION['total_ques']=$row['total_questions'];
		header("Location:quiz.php");
	}
	else{
		header("Location:index.php#availableQuizes");	
	}
}
else{
	header("Location:index.php#availableQuizes");
}

?>