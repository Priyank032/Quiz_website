<?php
include 'connection.php';
session_start();


if(isset($_SESSION['startQuizCid'])){
	header("Location:quiz.php");	
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Online Quiz</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

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

  <style type="text/css">
    .coding_bg{
      background: url('assets/img/laptop1-bg.jpg') top center;
      background-attachment: fixed;
    }
  </style>

</head>

<body>

  <?php include 'header.php';?>
  <script type="text/javascript">
  	document.getElementById('index').style.color='#5fcf80';
  </script>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="coding_bg d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>Learning Today,<br>Leading Tomorrow</h1>
      <h2>Take the test and improve your programming skills. You'll have to deal with basics, syntax and object-oriented programming. </h2>
      <a href="#availableQuizes" class="btn-get-started">Quizes</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">
  	<!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row counters">
        	<?php 
        		$students_query=mysqli_query($db,"select count(uid) as students from user_register");
        		$students=mysqli_fetch_array($students_query);

        		$courses_query=mysqli_query($db,"select count(cid) as courses from course");
        		$courses=mysqli_fetch_array($courses_query);

        		$questions_query=mysqli_query($db,"select count(qid) as questions from questions");
        		$questions=mysqli_fetch_array($questions_query);

        		$submited_query=mysqli_query($db,"select count(rid) as submited from quiz_result");
        		$submited=mysqli_fetch_array($submited_query);
        	?>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $students['students'];?>" data-purecounter-duration="0.5" class="purecounter"></span>
            <p>Students</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $courses['courses'];?>" data-purecounter-duration="0.5" class="purecounter"></span>
            <p>Courses</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $questions['questions'];?>" data-purecounter-duration="0.5" class="purecounter"></span>
            <p>Questions</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="<?php echo $submited['submited'];?>" data-purecounter-duration="0.5" class="purecounter"></span>
            <p>Submited Quizes</p>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->


    <!-- ======= Quizes Section ======= -->
	<span id="availableQuizes"></span>
	<br>
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">          
          <div class="col-lg pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Available Quizes</h3>
            <p class="fst-italic">
              Following quiz provides Multiple Choice Questions (MCQs). You will have to read all the given questions carefully and click over the correct answer option. If you are not sure about the answer then you can proceed to the next question. You can use Next button to moving to next questions in the quiz.
            </p>
            <div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
				  <thead>
				    <tr class="text-center">
				    	<th scope="col">Sr.</th>
	 			      	<th scope="col">Course</th>
						<th scope="col">Duration</th>
						<th scope="col">Total Questions</th>
						<th scope="col">Correct Answer Marks</th>
						<th scope="col">Incorrect Answer Marks</th>
						<th scope="col">Passing Percentages</th>
						<th scope="col">Status</th>
				    </tr>
				  </thead>
				  <tbody class="text-center">
				  	<?php
						$data=mysqli_query($db,"select * from course c, quiz_details qd where c.cid=qd.cid");
						$cnt=1;
						while($row=mysqli_fetch_array($data)){

							echo "<tr>";
							echo "<th scope='row'>$cnt</th>";
							$cnt++;
							echo "<td>$row[cname]</td>";
							echo "<td>$row[duration_minutes] minutes</td>";
							echo "<td>$row[total_questions]</td>";
							echo "<td>$row[correct_marks]</td>";
							echo "<td>$row[incorrect_marks]</td>";
							echo "<td>$row[passing_percentages]%</td>";

							if(isset($_SESSION['uid'])){
								$not_eligible_quiz_query=mysqli_query($db,"select * from quiz_result where testid=$row[testid] and cid=$row[cid] and uid=$_SESSION[uid]");
								$not_eligible_quiz=mysqli_fetch_array($not_eligible_quiz_query);
								if($not_eligible_quiz){
									echo "<td><span style='cursor:not-allowed;'>";
									echo "<button type='button' class='btn btn-secondary' disabled>Start</button></span>";
									echo "<p style='margin-top:10px;'>You Already Gave This Test.</p></td>";
								}
								else{
									echo "<td><a href='startQuiz.php?cid=$row[cid]&testid=$row[testid]' class='get-started-btn'>Start</a></td>";
								}
							}
							else{
								echo "<td><a href='login.php' class='get-started-btn'>Start</a></td>";
							}

							echo "<tr>";
						}
					?>
				    
				  </tbody>
				</table>
			</div>

          </div>
        </div>

      </div>
    </section><!-- End Quizes Section -->

<hr style="width:83%; margin:auto;" >

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>Why Choose Online Quiz?</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus optio ad corporis.
              </p>
              <div class="text-center">
                <a href="#availableQuizes" class="more-btn">Available Quizes <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-receipt"></i>
                    <h4>Courses</h4>
                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Quizes</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class='bx bxs-chevrons-up'></i>
                    <h4>Rank</h4>
                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

  </main><!-- End #main -->

  <?php include 'footer.php';?>

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