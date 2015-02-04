<?php
	session_start();
	include("datos.php");
	include($topPage); 
 	include($cabecera);
	include($funciones);	
	if(isset($_SESSION['user'])){
		if(isset($_GET['user'])){
			if(!esUsuario(addslashes($_GET['user'])))
				die('Error: No es un Usuario Valido');		
?>
	<center>
	<h1>Usuario <?php echo getUsuario($_GET['user'])?></h1>
    <?php datosUsuario($_GET['user'])?>
    </center>
<?php 
	}else{
		if(isset($_GET['update'])){
			echo '<center><h1>Datos Modificados';
			echo strftime(" en hora: %c");
			echo '</h1>';
		}else{
?>
		<center><h1>Modificar Datos de Usuario <?php echo '</h1>';}?>
        <form method="post" action="utils/updateDataUser.php">
       	Nombre Completo:&nbsp;&nbsp;<input type="text" name="nombre" value="<?php echo getNombreUsuario();?>"/><br />
        Apellidos:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="apellido" value="<?php echo getApellidoUsuario();?>" /> <br />
        Nombre de Usuario:<input type="text" name="user" value="<?php echo $_COOKIE['nombre'];?>"/><br />      
        New Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="pass1" value=""/><br />
		Repetir Password:&nbsp&nbsp;&nbsp;<input type="password" name="pass2"/><br />
		Password Anterior:&nbsp;<input type="password" name="passAnt"/><br />
        <input type="checkbox" name="rastreo" <?php echo muestraCorreo();?>/>Mostrar Correo<br /><br />
        <input type="submit" name="submit" value="Guardar Cambios"/> 
        </form>
        <h1></h1>
       </center>
<?php
	}
}else{
	die('Error: Usted no esta autorizado para visualizar esta pagina');
}
include($piePagina); 
?>