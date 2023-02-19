<?php
include 'connection.php';
session_start();


if(!(isset($_SESSION['uid']))){
	header("Location:login.php");
}

if( !(isset($_POST['submitQuiz'])) && isset($_SESSION['startQuizCid']) ){
	echo "<h4>You did not Submit your Quiz.</h4>";
	echo "<a href='quiz.php'>Return to Quiz</a>";
}


if( !(isset($_SESSION['quizData'])) && !(isset($_SESSION['startQuizCid'])) && !(isset($_SESSION['testid'])) ){
	header("Location:viewResults.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Quiz Result | Online Quiz</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>
	<?php include 'header.php';	?>
	
	<main id="main">
		<!-- ======= Breadcrumbs ======= -->
	    <div class="breadcrumbs" data-aos="fade-in">
	      <div class="container">
	        <h2>Quiz Result</h2>
	      </div>
	    </div><!-- End Breadcrumbs -->

	    <section id="course-details" class="course-details container">
<?php

$uid=$_SESSION['uid'];

$quizDataArr= $_SESSION['quizData'];

$startQuizCid= $_SESSION['startQuizCid'];
$testid= $_SESSION['testid'];
$total_ques=$_SESSION['total_ques'];

//Last submit question id
$qid= $_POST['qid'];

//Last Question user option
if(isset($_POST['userSelectedOp'])){
	$userSelectedOp= $_POST['userSelectedOp'];
	$quizDataArr[$qid]['userOp']= $userSelectedOp;
}


$correct_ans_cnt=0;
$incorrect_ans_cnt=0;

foreach ($quizDataArr as $qid => $data ) {
	$userOp=$data['userOp'];
	$correctOp=$data['correctOp'];
	if($userOp!=-1){
		if($userOp==$correctOp){
			$correct_ans_cnt+=1;	
		}
		else{
			$incorrect_ans_cnt+=1;
		}
	}
}

$criteria_query=mysqli_query($db,"select correct_marks, incorrect_marks, passing_percentages from quiz_details where cid=$startQuizCid and testid=$testid");
$criteria=mysqli_fetch_array($criteria_query);

$user_marks=($correct_ans_cnt*$criteria['correct_marks'])-($incorrect_ans_cnt*abs($criteria['incorrect_marks']));

$total_marks=$total_ques*$criteria['correct_marks'];
$percentage=round(($user_marks*100)/$total_marks);

if($percentage>=$criteria['passing_percentages']){
	$status='pass';
}
else{
	$status='fail';	
}

$attempt=$correct_ans_cnt+$incorrect_ans_cnt;

date_default_timezone_set('Asia/Kolkata');
$now=time();
$Time = date('Y-m-d H:i:s', $now);
$quiz_result_insert_query="insert into quiz_result(testid,uid,cid,total_questions,correct_ans,incorrect_ans,marks,percentage,submit_time,status) values($testid,$uid,$startQuizCid,$total_ques,$correct_ans_cnt,$incorrect_ans_cnt,$user_marks,$percentage,'$Time','$status')";
$inserted=mysqli_query($db,$quiz_result_insert_query);

$resultId_query=mysqli_query($db,"select LAST_INSERT_ID() as rid from quiz_result where testid=$testid and uid=$uid and cid=$startQuizCid and marks=$user_marks order by rid desc");
$resultId=mysqli_fetch_array($resultId_query)['rid'];
$security_key=1234;
$resultId=$resultId+$security_key;

?>
<div class="container" data-aos="fade-up">
    <div class="row">
		<div class="col-lg-7">
			<img src="assets/img/events-2.jpg" class="img-fluid" alt="result_img">
		</div>
		<div class="col-lg">
			<div class="course-info d-flex justify-content-between align-items-center">
			  <h5>Result Id</h5>
			  <p><?php echo $resultId;?></p>
			</div>
			<div class="course-info d-flex justify-content-between align-items-center">
			  <h5>Questions</h5>
			  <p><?php echo $total_ques;?></p>
			</div>
			<div class="course-info d-flex justify-content-between align-items-center">
			  <h5>Attempt</h5>
			  <p><?php echo $attempt;?></p>
			</div>
			<div class="course-info d-flex justify-content-between align-items-center">
			  <h5>Correct</h5>
			  <p><?php echo $correct_ans_cnt;?></p>
			</div>
			<div class="course-info d-flex justify-content-between align-items-center">
			  <h5>Incorrect</h5>
			  <p><?php echo $incorrect_ans_cnt;?></p>
			</div>
			<div class="course-info d-flex justify-content-between align-items-center">
			  <h5>Marks</h5>
			  <p><?php echo $user_marks;?></p>
			</div>
			<div class="course-info d-flex justify-content-between align-items-center">
			  <h5>Percentage</h5>
			  <p><?php echo $percentage;?>%</p>
			</div>
			<div class="course-info d-flex justify-content-between align-items-center">
			  <h5>Status</h5>
			  <p><?php 
			  	if($status=='pass'){
			  		echo "<font color='green'>Pass</font>";
			  	}
			  	else{
			  		echo "<font color='red'>Fail</font>";
			  	}
			  ?></p>
			</div>
		</div>
    </div>
</div>
<br>
<?php

$cnt=1;
foreach ($quizDataArr as $qid => $data ) {
	$userOp=$data['userOp'];
	
	$correctOp=$data['correctOp'];

	$escape_string_que=str_replace("<", "&lt;", $data['question']);
	$escape_string_que=nl2br($escape_string_que);

	echo "<h4>Que no.".$cnt++.":</h4><p>".$escape_string_que."</p>";
	if($userOp!=-1){
		echo "<p>Your ans: <b>".$data['op'.$userOp]."</b></p>";
		if($userOp==$correctOp){
			echo "<p><font color='green'>Correct</font></p>";
		}
		else{
			echo "<p><font color='red'>Incorrect</font></p>";
			echo "<p>Right ans is: <b>".$data['op'.$correctOp]."</b></p>";
		}
	}
	else{
		echo "<p>Not answered.</p>";
		echo "<p>Right ans is: <b>".$data['op'.$correctOp]."</b></p>";
	}
	if($cnt<=$total_ques){
		echo "<hr>";
	}
}

unset($_SESSION['quizEndTime']);
unset($_SESSION['startQuizCid']);
unset($_SESSION['testid']);
unset($_SESSION['total_ques']);

unset($_SESSION['q_index']);
unset($_SESSION['quizData']);
unset($_SESSION['qids']);

?>

</section>
</main>

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/purecounter/purecounter.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
</body>
</html>
