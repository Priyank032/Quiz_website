<?php
session_start();

if(isset($_SESSION['uid'])){
  header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registration | Online Quiz</title>
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

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- reCaptcha api -->
  <script src="https://www.google.com/recaptcha/api.js?render=6LfA8_caAAAAAFH2Goirefxzskx5MQ-dd8WUGGEh"></script>

  <!-- Loader -->
  <link rel="stylesheet" type="text/css" href="assets/css/loader.css">

  <style type="text/css">
    .register_btn{
      border: none;
      width: 140px;
      height: 40px;
      letter-spacing: 1px;
      font-size: 16px;
    }
  </style>

</head>

<body>

  <?php include 'header.php';?>
  <script type="text/javascript">
  	document.getElementById('register').style.color='#5fcf80';
  </script>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Registration</h2>
      </div>
    </div><!-- End Breadcrumbs -->


    <!-- ======= Register Section ======= -->
    <section id="contact" class="contact">
      
      <div class="container" data-aos="fade-up">

        <div class="row mt-2">

          <center>
          <div class="col-lg-4 mt-5 mt-lg-0">

            <form id="register_form" method="post" role="form" class="">

              <div class="form-group mt-3">
                <input type="text" class="form-control" name="uname" placeholder="Name" required="true">
              </div>
              <div class="form-group mt-3">
                <input type="email" class="form-control" name="uemail" placeholder="Email" required="true">
              </div>
              <div class="form-group mt-3">
                <input type="password" class="form-control" name="upwd" placeholder="Password" required="true">
              </div>
              <br>
              <div class="text-center">
                <input type="submit" name="submit" class="get-started-btn register_btn" value="Register">
              </div>
            </form>
            <br>
            <div class="loader" style="display: none;"></div>
            <h5 id="result"></h5>
          </div>
        </center>

        </div>

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

<script type="text/javascript">
  
  $(document).ready(function(){
    
    const insert=()=>{
      $.ajax({
          url:"register_details.php",
          type:"post",
          data:$('#register_form').serialize(),
          catch:false,
          success:function(result){
            $('.loader').css("display","none");
            if(parseInt(result)){
              $('#result').text("Registration Successful");
              $('input[name=uname]').val("");
              $('input[name=uemail]').val("");
              $('input[name=upwd]').val("");
            }
            else{
              $('#result').text("Unsuccessful Registration... May be Email Already Register"); 
            }
          }
        });
      }

    $('#register_form').submit(function(event){  
      event.preventDefault();
      $('#result').text("");
      grecaptcha.execute('6LfA8_caAAAAAFH2Goirefxzskx5MQ-dd8WUGGEh', {action: 'submit'})
      .then(function(token) {
         $('.loader').css("display","block");
         // console.log(token);
         $.ajax({
           url:"validate_recaptcha.php",
           type:'post',
           cache:false,
           data:`token=${token}`,
           success:function(result){
             // console.log(result);
             result= JSON.parse(result);
             if(result['success']){
               insert();
             }
             else{
               alert('Invalid Captcha!');
               $('.loader').css("display","none");
             }
           }
         })
      });
    });
  });
</script>

</html>