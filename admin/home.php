<?php
include 'connection.php';
session_start();

if(!(isset($_SESSION['adminId']))){
	header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home | Online Quiz</title>
    <link href="../assets/img/favicon.png" rel="icon">
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link href="images/fontawesome-free/css/all.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
</head>

<body>
<?php include 'header.php';?>

<div class="wrapper">
    <div class="container">
        <div class="row">
        	<?php include 'sidebar.php';?>
        	<script type="text/javascript">
        		document.getElementById('home').style.color="white";
        	</script>

            <div class="span9">
                <div class="content">
                    <div class="btn-controls">
                        <div class="btn-box-row row-fluid">
                        	<?php 
                        		$count_users=mysqli_query($db,"select count(uid) as users from user_register");
                        		$users=mysqli_fetch_array($count_users)['users'];

                        		$count_courses=mysqli_query($db,"select count(cid) as courses from course");
                        		$courses=mysqli_fetch_array($count_courses)['courses'];

                        		$count_questions=mysqli_query($db,"select count(qid) as questions from questions");
                        		$questions=mysqli_fetch_array($count_questions)['questions'];
                        	?>
                            <a class="btn-box big span4"><i class="icon-group"></i><b><?php echo $users;?></b>
                                <p class="text-muted">Users</p>
                            </a>
                            <a class="btn-box big span4"><i class="fas fa-language"></i></i><b><?php echo $courses;?></b>
                                <p class="text-muted">Courses</p>
                            </a>
                            <a class="btn-box big span4"><i class="fas fa-calculator"></i></i></i><b><?php echo $questions;?></b>
                                <p class="text-muted">Questions</p>
                            </a>
                        </div>

                        <!-- <div class="btn-box-row row-fluid">
                            <div class="span13">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <a class="btn-box small span4"><i class="icon-envelope"></i><b>Messages</b>
                                        </a><a href="#" class="btn-box small span4"><i class="icon-user"></i><b>Clients</b>
                                        </a><a href="#" class="btn-box small span4"><i class="icon-exchange"></i><b>Expenses</b>
                                        </a>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <a href="#" class="btn-box small span4"><i class="icon-save"></i><b>Total Sales</b>
                                        </a><a href="#" class="btn-box small span4"><i class="icon-bullhorn"></i><b>Social Feed</b>
                                        </a><a href="#" class="btn-box small span4"><i class="icon-sort-down"></i><b>Bounce
                                            Rate</b> </a>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                    <!--/#btn-controls-->
                </div>
                <!--/.content-->
            </div>
            <!--/.span9-->


		</div>
		<!--/.row-->
	</div>
	<!--/.container-->
</div>
<!--/.wrapper-->

<?php include 'footer.php';?>

<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="scripts/common.js" type="text/javascript"></script>

</body>

</html>