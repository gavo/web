<?php	
	header("Content-Type: text/html;charset=utf-8");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VIDEO <?php echo $_GET['url']?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="jwplayer.js"></script>
<script src="jwplayer.html5.js"></script>
</head>
<body>
	<div align="center"><img src="http://elcallejon.com/web/logo.png" width='800' height='70'></div><br />
    <div align="center" >
		<?php  		
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
		echo "<h2>VIDEO: ".$_GET['c']."</h2>\n";
            if(isset($_GET['url']) && isset($_GET['c'])){
				$extensiones = array(".mp4",".flv",".m4v",".f4v",".mov");
                if(in_array(substr(strtolower($_GET['c']),-4),$extensiones) || in_array(substr(strtolower($_GET['c']),-5),$extensiones)){
					echo "<div id='player' ></div>
						<script type='text/javascript'>jwplayer('player').setup({
								file: '".$_GET['url'].'/'.$_GET['c']."',
								image: '".buscar_imagen_ruta($_GET['url'])."',
								width: '600',
								height: '400',
								aspectratio: '16:9',
								primary: 'flash'
							});
						</script>";	 
                }else	
				if((strtolower(substr($_GET['c'],-5))== ".webm")){
					echo "<div id='playerhtml5'></div>
						<script type='text/javascript'>
							jwplayer('playerhtml5').setup({
								file: '".$_GET['url'].'/'.$_GET['c']."',
								image: '".buscar_imagen_ruta($_GET['url'])."',
								width: '600',
								height: '400',
								aspectratio: '16:9'
							});
						</script>";
				}else
				echo "FORMATO NO SOPORTADO - Estoy trabajando en esto, Disculpe las molestias";
				
            }else{				
				echo "enlace no valido";				
				
            }
            echo '<br><br>';
        ?>
    </div>
</body>
</html>
