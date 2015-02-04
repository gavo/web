<?php
	$idse=$_GET['ids'];
	session_start(); 
	unset($idse);
	session_destroy();
	$_SESSION = array();
	HEADER("Location:http://".$_SERVER['HTTP_HOST']);
?>