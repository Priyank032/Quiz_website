<?php
include 'connection.php';

if( isset($_POST['uname']) && isset($_POST['uemail']) && isset($_POST['upwd']) ){
	$uname=$_POST['uname'];
	$uemail=$_POST['uemail'];
	$upwd=$_POST['upwd'];

	$sql=mysqli_query($db,"insert into user_register(uname,uemail,upwd) values('$uname','$uemail','$upwd')");
	if($sql){
		echo 1;
	}
	else{
		echo 0;
	}	
}
else{
	header("Location:register.php");
}

?>