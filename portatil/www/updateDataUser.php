<?php
	$idse=$_GET['ids'];
	session_start();	
	include("funciones.php");
	if(!isset($_SESSION['user'])){
		die('Error: Usted no esta autorizado para abrir esta pagina');
	}
	include('db_conect.php');
	$consulta = "SELECT * FROM `user` WHERE usuario ='".$_COOKIE['nombre']."';";
	$resultado = $mysqli->query($consulta);
	if($resultado){
		while($fila = $resultado->fetch_assoc()){
			$user = $fila['usuario'];
			$id = $fila['id'];
			$pass = $fila['pass'];
			$nombre = $fila['nombre'];
			$apellido = $fila['apellido'];
			$verCorreo = $fila['verCorreo'];
		}
	}
		
	if(!($_SESSION['user']==$_POST['user'])){
		if(existeUsuario($_POST['user']))	
			die('Error: Existe otro usuario registrado con el mismo nombre');
		else
			$user = $_POST['user'];
	}
	
	if(!($_POST['pass1']=='')){
		if(!($_POST['pass1']==$_POST['pass2']))
			die('ERROR: LA CONFIRMACION PASSWORDS ES DIFERENTES A LA PASSWORD INGRESADA');	
		if(($pass == sha1($_POST['passAnt'])))
			$pass = sha1($_POST['pass1']);
		else
			die('Error: No escribio bien su password actual');
	}
	
	if(!isset($_POST['rastreo']))
		$verCorreo = 0;
	else
		$verCorreo = 1;
	
	if($_POST['nombre']=='')
		die('Error: EL Nombre No es Valido');
	
	if($_POST['apellido']=='')
		die('Error: EL Apellido No es Valido');
	
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	
	$consulta = " UPDATE `videoteca`.`user` SET `usuario`='".$user."',`pass`='".$pass."', `nombre`='".$nombre."', `apellido`='".$apellido."', `verCorreo`='".$verCorreo."' WHERE `id`='".$id."';";
	$resultado = $mysqli->query($consulta);
	
	if($resultado){
		unset($idse);
		session_destroy();	
		$_SESSION = array();		
		session_start(); 
		$_SESSION['user'] = $user;		
		$mysqli->close();
		header ("Location: http://".$_SERVER['SERVER_NAME']."/usuario.php?update=true");	
	}
		
?>