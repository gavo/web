<?php
	if(!isset($_POST['submit'])){
		$user = (isset($_COOKIE['nombre'])) ? $_COOKIE['nombre'] :'';
	include("datos.php");
	include($topPage); 
 	include($cabecera);
	include($funciones);
?>
		<h1></h1>
		<center><h1>Identificarse</h1>
		<div id="box">
			<form method="post" action="identificarse.php">
				Usuario:&nbsp&nbsp <input type="text" name="user" value="<?php '.$user.'?>"/><br />
				Password:<input type="password" name="pass"/><br />
				<input type="checkbox" name="rastreo" checked="checked"/>Recuerdame
				<input type="submit" name="submit" value="ingresar"/>        
			</form>
		</div>
		<h1></h1>
        <h1>Registrarse</h1>
        <div>
   <form method="post" action="registrarse.php">
Nombre Completo:&nbsp;&nbsp;<input type="text" name="nombre" value=""/><br />
Apellidos:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="apellido" value="" /> <br />
Nombre de Usuario:<input type="text" name="user" value=""/><br />
Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="pass1"/><br />
Repetir Password:&nbsp&nbsp;&nbsp;<input type="password" name="pass2"/><br /><br />
Acepar Terminos de Registro<input type="checkbox" name="rastreo"/>Acepto<br /><br />
				<input type="submit" name="submit" value="Registrar"/> <br /><br />              
        </form>
        </div></center>
<?php
	include($piePagina);
	}else{
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		if(empty($user)){
			die('Error: Por favor ingrese su Nombre de Usuario');
		}
		if(empty($pass)){
			die('Error: Por favor escriba su Password');	
		}
		include("utils/db_conect.php");
		$sql = "SELECT COUNT(*)total FROM videoteca.user WHERE usuario='".mysql_real_escape_string($user)."' AND pass='".sha1($pass)."' AND activo='1';";
		$resultado = $mysqli->query($sql);
		if($resultado){
			$correcto = false;
			while($fila = $resultado->fetch_assoc()){
				if($fila['total']==1)
					$correcto = true;
			}
			if($correcto==true){
				session_start();
				$_SESSION['user']=$user;
				if($_POST['rastreo']){
					setcookie('nombre',$_POST['user'],mktime()+86400);	
				}
				header('location: index.php');
			}else{
				echo 'El Nombre de Usuario o su Password no Corresponden a una cuenta del Servidor o Su cuenta ha sido Bloqueada';	
			}				
			$mysqli->close();	
		}
	}
?>