<?php
include 'connection.php';
session_start();

if(!(isset($_SESSION['uid']))){
  header("Location:login.php");
}

$uid=$_SESSION['uid'];
$resultId_secutityKey=1234;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Results | Online Quiz</title>
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

  <?php include 'header.php';?>
  <script type="text/javascript">
  	document.getElementById('viewResults').style.color='#5fcf80';
  </script>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>All Quizes Results</h2>
      </div>
    </div><!-- End Breadcrumbs -->
    
    <br>
    <br>

    <!-- ======= Register Section ======= -->
    <section id="contact" class="contact">
      <div class="table-responsive container">

          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Sr.</th>
                <th>Result Id</th>
                <th>Course</th>
                <th>Total Questions</th>
                <th>Attempt</th>
                <th>Correct</th>
                <th>Incorrect</th>
                <th>Not Answered</th>
                <th>Marks</th>
                <th>Percentages</th>
                <th>Status</th>
                <th>Submission Time</th>
                <th>Position</th>
              </tr>
            </thead>
              
            <?php

            $data=mysqli_query($db,"select * from quiz_result qr, course c where qr.uid=$uid and qr.cid=c.cid order by qr.submit_time desc");
            $cnt=1;
            while($row=mysqli_fetch_array($data)){
              $total_attempt=$row['correct_ans']+$row['incorrect_ans'];
              $not_answered=$row['total_questions']-$total_attempt;
              $resultId=$row['rid']+$resultId_secutityKey;

              echo "<tr>";
              echo "<td>$cnt</td>";
              $cnt++;
              echo "<td>$resultId</td>";
              echo "<td>$row[cname]</td>";
              echo "<td>$row[total_questions]</td>";
              echo "<td>$total_attempt</td>";
              echo "<td>$row[correct_ans]</td>";
              echo "<td>$row[incorrect_ans]</td>";
              echo "<td>$not_answered</td>";
              echo "<td>$row[marks]</td>";
              echo "<td>$row[percentage]%</td>";

              if($row['status']=='pass'){
                echo "<td><font color='green'>Pass</font></td>";
              }
              else{
                echo "<td><font color='red'>Fail</font></td>";
              }

              $submission_time=date_create($row['submit_time']);
              echo "<td>".date_format($submission_time,"d-M-Y h:i:s A")."</td>";

              $rank_query=mysqli_query($db,"select dense_rank() OVER(order by marks desc) AS rank,uid,marks from quiz_result");
              while($row=mysqli_fetch_array($rank_query)){
                if($row['uid']==$uid){
                  echo "<td>$row[rank]</td>";
                  break;
                }
              }
              
              echo "</tr>";
            }
            ?>
        </table>
      </div>
    </section><!-- End Register Section -->

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