<?php
include 'connection.php';
session_start();

if(!(isset($_SESSION['uid']))){
	header("Location:login.php");
}

if(!(isset($_SESSION['startQuizCid']))){
	header("Location:index.php#availableQuizes");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Live Quiz | Online Quiz</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet"> -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <!-- <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <script src="assets/js/quizTimer.js"></script>

  <link rel="stylesheet" type="text/css" href="assets/css/liveQuizStyle.css">
  
  <style>  	
    label, input[type='radio']{
        cursor:pointer;
    }
  </style>
</head>

<body onload="Timer('<?php echo $_SESSION['quizEndTime']?>','<?php echo $_SESSION['quizstartTime']?>');">

	<!-- ======= Header ======= -->
	  <header id="header" class="fixed-top" style="height:71px;">
	    <div class="container d-flex align-items-center">
	      <h1 class="logo me-auto"><a>Online Quiz</a></h1>

		    <nav class="navbar order-last order-lg-0">
				<div class="icon-box">
		        	<i class="hourglass bx bi-alarm"> <span id="rem_time"></span></i>
		      	</div>
		    </nav>
	    </div>
	  </header><!-- End Header -->

  	<main id="main">

	    <!-- ======= Breadcrumbs ======= -->
	    <div class="breadcrumbs" data-aos="fade-in" style="padding: 8px;">
	      <div class="container">
	        <h2>Quiz is live</h2>
		


			
	      </div>
	    </div><!-- End Breadcrumbs -->

		
		<?php
			if( !(isset($_SESSION['q_index'])) && !(isset($_SESSION['quizData'])) && !(isset($_SESSION['qids'])) ){
				$_SESSION['q_index']=0;

				$data_query=mysqli_query($db,"SELECT q.qid, q.question, q.op1, q.op2, q.op3, q.op4, q.correct_ans FROM questions q, course c WHERE c.cid=q.cid AND c.cid=$_SESSION[startQuizCid] ORDER BY rand() LIMIT $_SESSION[total_ques]");
				
				$qids=[];
				$quizData=[];

				while($row=mysqli_fetch_array($data_query)){
					$qids[]=$row['qid'];
					$quizData[$row['qid']]=array(
						'question'=>$row['question'],
						'op1'=>$row['op1'],
						'op2'=>$row['op2'],
						'op3'=>$row['op3'],
						'op4'=>$row['op4'],
						'userOp'=>-1,
						'correctOp'=>$row['correct_ans']
					);
				}

				$_SESSION['quizData']=$quizData;
				$_SESSION['qids']=$qids;
			}

		?>


		<form action="quizResult.php" id="questionForm" method="POST" class="myform">
			<h4 id="ques_no"></h4>
			<p id="question"></p>
			<input type="hidden" name="q_index" readonly>
			<input type="hidden" name="qid" readonly>

			
			<div class="form-check">
				<input class="form-check-input" id="radio_1" type='radio' name='userSelectedOp' value='1'>
				<label class="form-check-label" for="radio_1" id="op1"></label>
			</div>
			<div class="form-check">
				<input class="form-check-input" id="radio_2" type='radio' name='userSelectedOp' value='2'>
				<label class="form-check-label" for="radio_2" id="op2"></label>
			</div>
			<div class="form-check">
				<input class="form-check-input" id="radio_3" type='radio' name='userSelectedOp' value='3'>
				<label class="form-check-label" for="radio_3" id="op3"></label>
			</div>
			<div class="form-check">
				<input class="form-check-input" id="radio_4" type='radio' name='userSelectedOp' value='4'>
				<label class="form-check-label" for="radio_4" id="op4"></label>
			</div>
				
			<div id="prevcontainer" style="display: none;">
				<button id="prev" class='btn btn-primary prev_btn'>PREV</button>
			</div>
			<div id="nextcontainer">
				<button id="next" class='btn btn-primary next_btn'>NEXT</button>
			</div>
			<br>
			<div>
				<button name="submitQuiz" id="submitbtn" type="submit" class='btn get-started-btn submit_btn'>Submit</button>
			</div>

		</form>

	</main>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Live Quiz Ajax Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <?php include 'liveQuiz_ajaxScript.php'; ?>
  
</body>
</html>
