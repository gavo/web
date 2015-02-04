<?php
	$mysqli = mysqli_connect('localhost','root','','videoteca');
	if($mysqli->connect_errno)
		echo "No se pudo establecer la conexion MySQL: ".$mysql->connect_errno;
?>
