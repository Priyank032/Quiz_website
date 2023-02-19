<?php
include 'connection.php';
session_start();

if(!(isset($_SESSION['adminId']))){
    header("Location:index.php");
}

if(isset($_POST['submit'])){
    $cid=$_POST['cid'];
    $total_questions=$_POST['total_questions'];

    $correct_marks=$_POST['correct_marks'];
    $incorrect_marks=-abs($_POST['incorrect_marks']);
    $passing_percentages=$_POST['passing_percentages'];
    $duration=$_POST['duration'];

    $sql=mysqli_query($db,"insert into quiz_details(cid,total_questions,duration_minutes,correct_marks,incorrect_marks,passing_percentages) values($cid,$total_questions,$duration,$correct_marks,$incorrect_marks,$passing_percentages)");
    if($sql){
        echo "<script>alert('Successfully Inserted')</script>";
        echo "<script>window.location.assign('quizDetailsForm.php');</script>";
    }
    else{
        echo "<script>alert('Unsuccessful Insertion')</script>";
        echo "<script>window.location.assign('quizDetailsForm.php');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Quiz | OQ</title>
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
        		document.getElementById('setQuiz').style.color="white";
        	</script>
                
                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Set Quiz</h3>
                            </div>
                            
                            <div class="module-body">

                                <form class="form-horizontal row-fluid" action="" method="POST">

                                    <div class="control-group">
                                        <label class="control-label" for="selectCourse">Select Course</label>
                                        <div class="controls">
                                            <select name="cid" id="selectCourse" tabindex="1" class="span8">
                                                <?php
                                                    $data=mysqli_query($db,"select * from course");
                                                    while($row=mysqli_fetch_array($data)){
                                                        echo "<option value=$row[0]>$row[1]</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="dur">Duration</label>
                                        <div class="controls">
                                            <input class="span8" type="number" name="duration" id="dur" rows="3" placeholder="Type Minutes Here..." required="true"/>
                                            
                                            <div class="alert" style="max-width: 382px;">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>Warning!</strong> Currently more than 60 Minutues is not allow.
                                            </div>

                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="ques">Questions</label>
                                        <div class="controls">
                                            <input class="span8" type="number" name="total_questions" id="ques" rows="3" placeholder="Type Total no. of Questions..." required="true"/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="corr_marks">Correct Marks</label>
                                        <div class="controls">
                                            <input class="span8" type="text" name="correct_marks" id="corr_marks" rows="3" placeholder="Type Marks per Correct answer..." required="true"/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="incorr_marks">Incorrect Marks</label>
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on">&minus;</span>
                                                <input class="span12" type="text" name="incorrect_marks" id="incorr_marks" placeholder="Type Marks per Incorrect ans." required="true"/>     
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="pass_per">Percentages</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input class="span12" type="text" name="passing_percentages" id="pass_per" placeholder="Minimum Passing Percentages." required="true"/>     
                                                <span class="add-on">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" name="submit" class="btn-inverse span8">Insert</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                            <!-- /Module Body -->
                        </div>
                        <!-- /Module -->

                        <div class="module">
                            <div class="module-head">
                                <h3>Quizes Details</h3>
                            </div>
                            <div class="module-body table">
                                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                                    <thead>
                                        <tr>
                                            <td>Course</td>
                                            <td>Duration</td>
                                            <td>Total Questions</td>
                                            <td>Correct Marks</td>
                                            <td>Incorrect Marks</td>
                                            <td>Passing Percentages</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $data=mysqli_query($db,"select * from course c,quiz_details q where q.cid=c.cid");
                                            while($row=mysqli_fetch_array($data)){
                                                echo "<tr>";
                                                echo "<td>$row[cname]</td>";
                                                echo "<td>$row[duration_minutes] minutes</td>";
                                                echo "<td>$row[total_questions]</td>";
                                                echo "<td>$row[correct_marks]</td>";
                                                echo "<td>$row[incorrect_marks]</td>";
                                                echo "<td>$row[passing_percentages]</td>";
                                                echo "<td><a href='#'>Update / Delete</a></td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--/.module-->

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