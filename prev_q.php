<?php 
session_start();

if( isset($_POST['q_index']) && isset($_POST['qid']) && isset($_POST['userSelectedOp']) && isset($_SESSION['q_index']) && isset($_SESSION['quizData']) ){

	$qid=$_POST['qid'];
	$userSelectedOp=$_POST['userSelectedOp'];

	$_SESSION['quizData'][$qid]['userOp']=$userSelectedOp;


	$_SESSION['q_index']=$_POST['q_index']-1;

	echo $_SESSION['q_index'];
}

?>