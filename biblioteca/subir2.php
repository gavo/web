<?php
	session_start();
	include("datos.php"); 	
	include($topPage); 
 	include($cabecera);
	include($funciones); 
	include($db);
	if(!isset($_SESSION['user']))
		die('Usted no esta autorizado para ver el contenido de esta pagina, por favor Ingrese con su Cuenta');	
	if($_POST['ttt']=="")
		die('Error: Debe Seleccionar un titulo para el Archivo');
	if($_POST['comentarios']=="")
		die("Error: Debe ingresar al menos una descripcion para el Archivo");
	if($_FILES['archivo']['name']=="")
		die("Error: Debe seleccionar un archivo");
	$listaExtension = array('video/avi','video/ogg','video/x-ms-wmv','video/mpeg','application/octet-stream','video/webm',
							'video/x-dv','video/mp4','video/quicktime','video/3gpp','video/x-ms-asf','video/3gpp2','video/x-matroska',
							'application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/msword',
							'application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
							'application/vnd.ms-powerpoint','application/vnd.openxmlformats-officedocument.presentationml.presentation',
							'application/x-rar','application/x-zip-compressed');
	$listaNoVideo   = array('application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/msword',
							'application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
							'application/vnd.ms-powerpoint','application/vnd.openxmlformats-officedocument.presentationml.presentation',
							'application/x-rar','application/x-zip-compressed');
	$extension = strtolower($_FILES['archivo']['type']);
	if(in_array($extension,$listaExtension)===false)
		die('Error: El archivo que subio, no esta registrado como contenido compartible con el sistema, hable con el Administrador');
	$consulta = "select id from `user` where usuario = '".mysql_real_escape_string($_COOKIE['nombre'])."';";
	$resultado = $mysqli->query($consulta);
	$uploader = 0;
	while($fila = $resultado->fetch_assoc()){									
		$uploader = $fila['id'];										
	}
		
	$consulta = "SELECT MAX(id_vid)+1 id_vid FROM material;";
	$resultado = $mysqli->query($consulta);
	$newNombre = 0;
	if($resultado){
		while($fila = $resultado->fetch_assoc()){									
			$newNombre = $fila['id_vid'];										
		}
	}
	if($newNombre == NULL)
		$newNombre = 1;
	$uploaddir = "";
	$categoria = $_POST['cat'];
	$contenido = $_POST['comentarios'];
	$titulo = $_POST['ttt'];
	$uploadfile = $uploaddir . basename($_FILES['archivo']['name']);
	$nombremp4 = substr("$uploadfile", 0, -4);
	$error = $_FILES['archivo']['error'];
	$subido = false;
	$newCat = $_POST['newCat'];
	if(!($newCat =="(Solo si no Encontro una Categoria Apropiada)")){
		$consulta = "SELECT COUNT(id_cat) cant, id_cat FROM categoria WHERE nombre='".mysql_real_escape_string($newCat)."';";		
		$resultado = $mysqli->query($consulta);
		if($resultado){
			while($fila = $resultado->fetch_assoc()){
				if($fila['cant']==0)
					$categoria=0;						
				else
					$categoria=$fila['id_cat'];
			}
		}	
		if($categoria==0){
			$consulta = "SELECT MAX(id_cat)+1 id_cat FROM categoria;";		
			$resultado = $mysqli->query($consulta);
			if($resultado){
				while($fila = $resultado->fetch_assoc()){
					if($fila['id_cat']==NULL){
						$categoria=1;
					}else{
						$categoria=$fila['id_cat'];
					}
				}
			}	
			$consulta = "INSERT INTO `videoteca`.`categoria`(`id_cat`,`nombre`) VALUES ( '".mysql_real_escape_string($categoria).
			"','".mysql_real_escape_string($newCat)."');";		
			$resultado = $mysqli->query($consulta);		
		}
	}
			
	if(isset($_POST['submit']) && $error==UPLOAD_ERR_OK) { 
		$subido = copy($_FILES['archivo']['tmp_name'], $uploadfile); 
	}	 	
	if((in_array($extension,$listaNoVideo)===true)){
		$ext = "";
		if($extension === 'application/pdf')
			$ext = 'pdf';
		if($extension === 'application/msword')
			$ext = 'doc';
		if($extension === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
			$ext = 'docx';
		if($extension === 'application/vnd.ms-excel')
			$ext = 'xls';
		if($extension === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
			$ext = 'xlsx';
		if($extension === 'application/vnd.ms-powerpoint')
			$ext = 'ppt';
		if($extension === 'application/vnd.openxmlformats-officedocument.presentationml.presentation')
			$ext = 'pptx';
		if($extension === 'application/x-zip-compressed')
			$ext = 'zip';
		if($extension === 'application/x-rar')
			$ext = 'rar';
		$consulta = "INSERT INTO `videoteca`.`material`(`id_vid`,`titulo`,`descripcion`,`dir`,`img`,`uploader`,`activo`,`tipo`)VALUES ('".
			mysql_real_escape_string($newNombre)."','".mysql_real_escape_string($titulo)."','".mysql_real_escape_string($contenido).
			"','vid/".mysql_real_escape_string($newNombre).'.'.$ext."','capt/".$ext.".jpg','".
			mysql_real_escape_string($uploader)."','0','0');";
			
		$resultado = $mysqli->query($consulta);			
		$consulta = "INSERT INTO `videoteca`.`asoc`(`id_cat`,`id_vid`) VALUES ('".
					mysql_real_escape_string($categoria)."','".mysql_real_escape_string($newNombre)."');";
		$resultado = $mysqli->query($consulta);
		copy($uploadfile,'vid/'.$newNombre.'.'.$ext);
		unlink($uploadfile);	
	}else{				
		if($subido) {
			$consulta = "INSERT INTO `videoteca`.`material`(`id_vid`,`titulo`,`descripcion`,`dir`,`img`,`uploader`,`activo`)VALUES ('".
			mysql_real_escape_string($newNombre)."','".mysql_real_escape_string($titulo)."','".mysql_real_escape_string($contenido).
			"','vid/".mysql_real_escape_string($newNombre).".webm','capt/".mysql_real_escape_string($newNombre).".jpg','".
			mysql_real_escape_string($uploader)."','1');";
			
			$resultado = $mysqli->query($consulta);			
			$consulta = "INSERT INTO `videoteca`.`asoc`(`id_cat`,`id_vid`) VALUES ('".
						mysql_real_escape_string($categoria)."','".mysql_real_escape_string($newNombre)."');";
			$resultado = $mysqli->query($consulta);
		} else {
			echo "Se ha producido un error: ".$error;	
		}
		$nombremp4 = "".$newNombre;
		$comando = 'C:\ffmpeg -i "'.$uploadfile.'" -s 200x150 -r 5 -ss 5 "capt/'.$nombremp4.'.jpg"';
		$convertir=(exec($comando,$output));
		echo $convertir."<br>";
		$comando = 'C:\ffmpeg -i "'.$uploadfile.'" -b:1200 -s:720×480 "vid/'.$nombremp4.'.webm"';
		$convertir=(exec($comando,$output));
		echo $convertir."<br>";	
		foreach($output as $item){
			echo $item;
		}	
		unlink($uploadfile);	
		$mysqli->close();
	}
	header ("Location: http://".$_SERVER['SERVER_NAME']."/ver.php?peli=".$newNombre);
	include($piePagina);
?>
