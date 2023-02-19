<?php
include 'connection.php';
session_start();

if(!(isset($_SESSION['adminId']))){
    header("Location:index.php");
}

if(isset($_POST['submit'])){
    $cname=$_POST['cname'];
    $cdesc=$_POST['cdesc'];
    $sql=mysqli_query($db,"insert into course(cname,cdesc) values('$cname','$cdesc')");
    if($sql){
        echo "<script>alert('Successfully Inserted')</script>";
        echo "<script>window.location.assign('courseInsertForm.php');</script>";
    }
    else{
        echo "<script>alert('Unsuccessful Insertion')</script>";
        echo "<script>window.location.assign('courseInsertForm.php');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Insert | OQ</title>
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
        		document.getElementById('courseInsert').style.color="white";
        	</script>
                
                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Course Insert Form</h3>
                            </div>
                            
                            <div class="module-body">

                                <form class="form-horizontal row-fluid" action="" method="POST">
                                    <div class="control-group">
                                        <label class="control-label" for="courseName">Course</label>
                                        <div class="controls">
                                            <input class="span8" type="text" name="cname" id="courseName" placeholder="Type Course Name here..." required="true">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="courseDesc">Description</label>
                                        <div class="controls">
                                            <textarea class="span8" name="cdesc" id="courseDesc" rows="5" required="true"></textarea>
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
                                <h3>Courses</h3>
                            </div>
                            <div class="module-body table">
                                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Course ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $data=mysqli_query($db,"select * from course");
                                            while($row=mysqli_fetch_array($data)){
                                                echo "<tr>";
                                                echo "<td>$row[0]</td>";
                                                echo "<td>$row[1]</td>";
                                                echo "<td>$row[2]</td>";
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