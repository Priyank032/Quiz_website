<?php
include 'connection.php';
session_start();

if(!(isset($_SESSION['adminId']))){
    header("Location:index.php");
}

if(isset($_POST['submit'])){
    $cid=$_POST['cid'];
    $question=mysqli_real_escape_string($db,$_POST['question']);
    $op1=mysqli_real_escape_string($db,$_POST['op1']);
    $op2=mysqli_real_escape_string($db,$_POST['op2']);
    $op3=mysqli_real_escape_string($db,$_POST['op3']);
    $op4=mysqli_real_escape_string($db,$_POST['op4']);
    $correct_ans=$_POST['correct_ans'];
    $ques_type=$_POST['ques_type'];

    $sql=mysqli_query($db,"insert into questions(cid,question,op1,op2,op3,op4,correct_ans,type) values($cid,'$question','$op1','$op2','$op3','$op4',$correct_ans,'$ques_type')");
    if($sql){
        echo "<script>alert('Successfully Inserted')</script>";
        echo "<script>window.location.assign('questionsInsertForm.php');</script>";
    }
    else{
        echo "<script>alert('Unsuccessful Insertion')</script>";
        echo "<script>window.location.assign('questionsInsertForm.php');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions Insert | OQ</title>
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
        		document.getElementById('questionsInsert').style.color="white";
        	</script>
                
                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Question Insert Form</h3>
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
                                        <label class="control-label" for="que">Question</label>
                                        <div class="controls">
                                            <textarea class="span8" name="question" id="que" rows="3" placeholder="Type Question Here..." required="true"></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="o1">Option 1</label>
                                        <div class="controls">
                                            <textarea class="span8" name="op1" id="o1" rows="2" placeholder="Type Option 1 Here..." required="true"></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="o2">Option 2</label>
                                        <div class="controls">
                                            <textarea class="span8" name="op2" id="o2" rows="2" placeholder="Type Option 2 Here..." required="true"></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="o3">Option 3</label>
                                        <div class="controls">
                                            <textarea class="span8" name="op3" id="o3" rows="2" placeholder="Type Option 3 Here..." required="true"></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="o4">Option 4</label>
                                        <div class="controls">
                                            <textarea class="span8" name="op4" id="o4" rows="2" placeholder="Type Option 4 Here..." required="true"></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Correct Option:</label>
                                        <div class="controls">
                                            <label class="radio inline">
                                                <input type="radio" name="correct_ans" id="optionsRadios1" value="1" checked="">
                                                Option 1
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label class="radio inline">
                                                <input type="radio" name="correct_ans" id="optionsRadios2" value="2">
                                                Option 2
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label class="radio inline">
                                                <input type="radio" name="correct_ans" id="optionsRadios3" value="3">
                                                Option 3
                                            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label class="radio inline">
                                                <input type="radio" name="correct_ans" id="optionsRadios4" value="4">
                                                Option 4
                                            </label>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="q_type">Type</label>
                                        <div class="controls">
                                            <select name="ques_type" id="q_type" tabindex="1" class="span8">
                                                <option value="easy">Easy</option>
                                                <option value="medium">Medium</option>
                                                <option value="hard">Hard</option>
                                            </select>
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
                                <h3>Questions</h3>
                            </div>
                            <div class="module-body table">
                                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>Course</th>
                                            <th>Question</th>
                                            <th>Option 1</th>
                                            <th>Option 2</th>
                                            <th>Option 3</th>
                                            <th>Option 4</th>
                                            <th>Correct OP</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $cnt=1;
                                            $data=mysqli_query($db,"select * from course c,questions q where q.cid=c.cid ORDER BY q.qid DESC");
                                            while($row=mysqli_fetch_array($data)){
                                                echo "<tr>";
                                                echo "<td>".$cnt++."</td>";
                                                echo "<td>$row[1]</td>";

                                                $escape_string=str_replace("<", "&lt;", $row['question']);

                                                echo "<td>".nl2br($escape_string)."</td>";
                                                echo "<td>$row[6]</td>";
                                                echo "<td>$row[7]</td>";
                                                echo "<td>$row[8]</td>";
                                                echo "<td>$row[9]</td>";
                                                echo "<td>$row[10]</td>";
                                                echo "<td>$row[11]</td>";
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