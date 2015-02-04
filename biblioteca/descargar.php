<?php
	session_start();
			if($_GET["vid"]<>""){
			$mysqli = mysqli_connect("localhost","root","","videoteca");							
			if($mysqli->connect_errno)
				echo "No se pudo establecer la conexion MySQL: ".$mysql->connect_errno;
			$consulta = "SELECT * from material where `id_vid`='".mysql_real_escape_string($_GET['vid'])."';";
			$resultado = $mysqli->query($consulta);
			$titulo = "";
			if($resultado){
				while($fila = $resultado->fetch_assoc()){									
					$titulo = $fila['titulo'];	
					$vid = $fila['dir'];									
				}
			}
			$mysqli->close();
			function gvm($vid){
				$vid = str_replace(" ","%20",$vid);
				$vid = str_replace("xlx",$codexxx,$vid);
				return $vid;
			}
			@header("Content-Type: video/webm");
			@@header('Content-Disposition: attachment; filename="'.$titulo.' [VideotecaInformatica].webm"');
			@readfile(gvm($vid));
			}else{
				print "<script> location.href='http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."'; </script>";
			}

?>