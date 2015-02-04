<?php  
	session_start();
	include("datos.php");
	include($topPage); 
 	include($cabecera);
	include($funciones);;
	if(!isset($_GET['peli'])){
		echo'<center><h1>Video Aleatorio</h1>';
		mostrarVideo("SELECT * FROM material WHERE activo='1' ORDER BY RAND() LIMIT 1;");
	}else{
		$sql = "SELECT COUNT(*)existe,tipo FROM material WHERE id_vid = '".mysql_real_escape_string($_GET['peli'])."' ";
		$resultado = $mysqli->query($sql);
		$existe = 0;
		$tipo = 1;
		while($fila = $resultado->fetch_assoc()){
			$existe = $fila['existe'];	
			$tipo = $fila['tipo'];		
		}
		if($existe == 0){
				echo'<center><h1>El material que busca no se encuentra disponible</h1>';
		}else{
			echo '<center><h1></h1>';
			if($tipo!=1)
				mostrarPdf("SELECT * FROM material WHERE id_vid='".mysql_real_escape_string($_GET['peli'])."' and tipo='0'");
			if($tipo==1)
				mostrarVideo("SELECT * FROM material WHERE id_vid='".mysql_real_escape_string($_GET['peli'])."' and tipo='1'");
			if(isset($_COOKIE['nombre']))
				contarVisita($_GET['peli'],$_COOKIE['nombre']);		
			else
				contarVisita($_GET['peli'],'');
		}
	}
	echo '<br><br>';
	include($piePagina);
?>