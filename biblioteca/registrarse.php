<?php
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$user = $_POST['user'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	if(empty($nombre))
		die('Error: Por favor ingrese su Nombre');
	if(empty($apellido))
		die('Error: Por favor ingrese su Apellido');
	if(empty($user))
		die('Error: Debe indicar su Nombre de Usuario');
	if(empty($pass1))
		die('Error: Debe escribir una Password');
	if(empty($pass2))
		die('Error: Debe Reescribir su Password');
	if(!isset($_POST['rastreo']))
		die('Error: No ha aceptado los terminos de Registro');
	if($pass1 != $pass2)
		die('Error: El Password Ingresado inicialmente no coincide con la Confirmacion de Password');	
	include("utils/db_conect.php");
	$sql = "SELECT COUNT(id) total FROM `user` WHERE usuario ='".$user."';";
	$resultado = $mysqli->query($sql);
	if($resultado){
		$correcto = false;
		while($fila = $resultado->fetch_assoc()){
			if($fila['total']==1)
				$correcto = true;
		}
		if($correcto==true)
			die('Error: El Nombre de Usuario no esta disponible');
	}
	$sql = "INSERT INTO `videoteca`.`user`(`usuario`,`pass`,`nombre`,`apellido`,`activo`) VALUES ('".mysql_real_escape_string($user)."','".sha1($pass1)."','".mysql_real_escape_string($nombre)."','".mysql_real_escape_string($apellido)."','0');"; 
	$resultado = $mysqli->query($sql);
	
	$mensaje = "Siga el siguiente enlace para que su cuenta sea Activada <a href='".$_SERVER['HTTP_HOST']."/utils/activar.php?a=".$cacti."' target='_blank' >Click Aqui</a>";
		
?>