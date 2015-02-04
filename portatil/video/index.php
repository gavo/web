<?php	
	header("Content-Type: text/html;charset=utf-8");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Videos</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div align="center"><a href='<?php echo "http://".$_SERVER['HTTP_HOST'];?>'><img src="logo.png" width='800' height='100'></a></div><br />
    <div align="center" >
	<?php
		function listar_directorios_ruta($ruta){
			$rt = opendir($ruta);
			while ($file = readdir($rt)) {
				if (is_dir($ruta."/".$file) && $file!="." && $file!=".."){
					echo "$ruta$file";
				}
			}
			echo $file;
		}		
	
		function buscar_imagen_ruta($ruta){
			$rt = opendir($ruta);
			while ($file = readdir($rt)){
				if (is_dir($ruta."/".$file) && $file!="." && $file!=".."){
					
				}else{
					$extensiones = array(".jpg",".png",".gif",".jpeg");
					if(in_array(substr(strtolower($file),-4),$extensiones) || in_array(substr(strtolower($file),-5),$extensiones)){
						return "$ruta/$file";
					}
				}
			}		
			$video = buscar_video_ruta($ruta);
			$comando = 'C:\ffmpeg -i "'.$video.'" -s 600x400 -r 25 -ss 25 "'.$ruta.'/imagen.jpg"';
			$convertir=(exec($comando,$output));
			return $ruta."/imagen.jpg";
		}		
	
		function buscar_video_ruta($ruta){
			$rt = opendir($ruta);
			while ($file = readdir($rt)){
				if (is_dir($ruta."/".$file) && $file!="." && $file!=".."){
					
				}else{
					$extensiones = array(".mp4",".webm",".flv",".m4v",".f4v",".mov");
					if(in_array(substr(strtolower($file),-4),$extensiones) || in_array(substr(strtolower($file),-5),$extensiones)){
						return "$ruta/$file";
					}
				}
			}
			return NULL;
		}

		if(!(isset($_GET['url']))){
			$directorio = opendir(".");
			echo '<table CELLPADDING=5 CELLSPACING=5 BORDER=5 BORDER bgcolor="#000000" align="center">';
			while ($archivo = readdir($directorio)){		
				if (is_dir($archivo)){
					if($archivo!="." && $archivo!=".." & $archivo != "configuradorJWPlayer"){
						echo "<tr><td width='600'><h2><a href='index.php?url=".$archivo."'>".$archivo."</a></h2></td>";	
						echo "<td><a href='index.php?url=".$archivo."'>"."<img src='".buscar_imagen_ruta($archivo)."' width='100' height='70'></a></td></tr>";	
					}
				}
			}
			echo "</table>";
			// agregado de aqui a abajo
			
			$directorio = opendir(".");
			$cont = -1;
			echo "<center><table>";
			$extensiones = array(".mp4",".webm",".flv",".m4v",".f4v",".mov");
			while ($archivo = readdir($directorio)){				
				if(in_array(substr(strtolower($archivo),-4),$extensiones) || in_array(substr(strtolower($archivo),-5),$extensiones)){		
					if($cont == -1 or $cont==5){
						if($cont==5)
							echo "</tr>";
						echo "<tr>";
						$cont = 1;
					}
					echo "<td>";
					echo "<div id='sobreponer'><img src='".buscar_imagen_ruta(".")."' width='180'  height='120'/>\n";
					$titulo = str_replace('.MP4','',strtoupper($archivo));
					$titulo = str_replace('.FLV','',$titulo);
					$titulo = str_replace('.WEBM','',$titulo);
					echo "<label class='letra'>".$titulo."</label>\n";
					
					echo "<a href='ver.php?url=Video&c=".$archivo."' target='_blank'>\n";
					echo "<img class='sobre' src='mascara.png' width='180' height='120'/></a>\n";						
					echo "</div></td>\n";								
					$cont = $cont+1;
				}
			}			
			echo "</table>";
		}else{
			$directorio = opendir($_GET['url']);
			echo '<table CELLPADDING=5 CELLSPACING=5 BORDER=5 bgcolor="#000000" align="center">';
			while ($archivo = readdir($directorio)){		
				if (is_dir($_GET['url']."/".$archivo)){
					if($archivo!="." && $archivo!=".."){
						echo "<tr><td width='600'><h2><a href='index.php?url=".$_GET['url']."/".$archivo."'>".$archivo."</a></h2></td>";	
						echo "<td><a href='index.php?url=".$_GET['url']."/".$archivo."'>"."<img src='".buscar_imagen_ruta($_GET['url']."/".$archivo)."' width='100' height='70'></a></td></tr>";	
					}
				}
			}
			echo "</table>\n";
		//para arriba agregado`
			$directorio = opendir($_GET['url']);
			$cont = -1;
			echo "<center><table>";
			$extensiones = array(".mp4",".webm",".flv",".m4v",".f4v",".mov");
			while ($archivo = readdir($directorio)){
				if(in_array(substr(strtolower($archivo),-4),$extensiones) || in_array(substr(strtolower($archivo),-5),$extensiones)){		
					if($cont == -1 or $cont==5){
						if($cont==5)
							echo "</tr>";
						echo "<tr>";
						$cont = 1;
					}
					echo "<td>";
					echo "<div id='sobreponer'><img src='".buscar_imagen_ruta($_GET['url'])."' width='180'  height='120'/>\n";
					$titulo = str_replace('.MP4','',strtoupper($archivo));
					$titulo = str_replace('.FLV','',$titulo);
					$titulo = str_replace('.WEBM','',$titulo);
					echo "<label class='letra'>".$titulo."</label>\n";
					
					echo "<a href='ver.php?url=".$_GET['url']."&c=".$archivo."' target='_blank'>\n";
					echo "<img class='sobre' src='mascara.png' width='180' height='120'/></a>\n";						
					echo "</div></td>\n";								
					$cont = $cont+1;
				}
			}			
			echo "</table>";
		}
	?>
</body>
</html>