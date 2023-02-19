<?php
$db=mysqli_connect("localhost","root","") or die("Failed to connect with server");
mysqli_select_db($db,"quiz1db") or die("Failed to connect with database");
?>