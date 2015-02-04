<?php
	if(!isset($_GET['a'])){
		die('Error: Usted no tiene acceso a esta Pagina');
	}	
	$acti = $_GET['a'];
	include("db_conect.php");
	$sql = "SELECT id FROM activar WHERE codigo='".mysql_real_escape_string($acti)."' AND estado ='1';";
	$resultado = $mysqli->query($sql);
	$id = 0;
	if($resultado){
		while($fila = $resultado->fetch_assoc()){
			$id = $fila['id'];
		}
		if($id == 0){
			die('Error: El enlace no es Valido');
		}	
		$sql = "UPDATE `videoteca`.`activar` SET `estado`='0' WHERE `id`='".mysql_real_escape_string($id)."';";
		$resultado = $mysqli->query($sql);
		$sql = "UPDATE `videoteca`.`user` SET `activo`='1' WHERE `id`='".mysql_real_escape_string($id)."';";	
		$resultado = $mysqli->query($sql);
		echo "<html>
				<head>
				<title>Redirigir</title>
				<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=http://".$_SERVER['HTTP_HOST']."'>
				</head>
				<body bgcolor='white'>
					Su Cuenta fue Activada Exitosamente<br>
					Usted sera redirigido a la pagina principal en 5 Segundos...
					Ingrese sus datos con el que se registro<br>			
				</body>
			</html> ";
	}
	$mysqli->close();
?>