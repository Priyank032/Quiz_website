<?php
include 'connection.php';
session_start();

if(isset($_SESSION['uid'])){
  header("Location:index.php");
}

if(isset($_POST['submit'])){
  $uemail=$_POST['uemail'];
  $upwd=$_POST['upwd'];
  
  $data=mysqli_query($db,"select * from user_register where uemail='$uemail' and upwd='$upwd'");
  if($row=mysqli_fetch_array($data)){
    $_SESSION['uid']=$row[0];
    header("Location:index.php");
  }
  else{
    echo "<script>alert('ID/Password not matched.')</script>";
    echo "<script>window.location.assign('login.php')</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login | Online Quiz</title>
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

</head>

<body>

  <?php include 'header.php';?>
  <script type="text/javascript">
    document.getElementById('login').style.color='#5fcf80';
  </script>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Login</h2>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Login Section ======= -->
    <section id="contact" class="contact">
      

      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <center>
          <div class="col-lg-4 mt-5 mt-lg-0">

            <form action="" method="post" role="form" class="">
              <div class="form-group mt-3">
                <input type="email" class="form-control" name="uemail" placeholder="Email" required="true">
              </div>
              <div class="form-group mt-3">
                <input type="password" class="form-control" name="upwd" placeholder="Password" required="true">
              </div><br>
              <div class="text-center">
                <input type="submit" name="submit" class="get-started-btn" style="border: none; width: 130px;" value="Login">
              </div>
            </form>

          </div>
        </center>

        </div>

      </div>
    </section><!-- End Login Section -->

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