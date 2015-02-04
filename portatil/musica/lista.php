<?php
	@header("Content-type:txt/xml");		
	@header('Content-Disposition: attachment; filename= lista.xml');
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	echo "<songs>\n";	
	if(isset($_GET['lista'])){	
		$directorio = opendir($_GET['lista']);
		while($archivo = readdir($directorio)){
			if(strtolower(substr($archivo,-4))==".mp3"){
				if($archivo!="." && $archivo!=".."){
					echo "<song \n";
					echo "\tpath=\"".$_GET['lista']."/".$archivo."\"\n";
					echo "\ttitle=\"".str_replace(".MP3","",strtoupper($archivo))."\"\n/>\n";
				}
			}
		}
	}
	if(isset($_GET['buscar'])){	
		$directorio = opendir(".");		
		while($subdirectorio = readdir($directorio)){
			if($subdirectorio != "." && $subdirectorio != ".." && is_dir($subdirectorio)){
				$dir_temp = $subdirectorio;
				$subdirectorio = opendir($subdirectorio);
				while($archivo = readdir($subdirectorio)){
					if(strtolower(substr($archivo,-4))==".mp3" && (strpos(strtoupper($dir_temp.'/'.$archivo), strtoupper($_GET['buscar'])) !== false)){
						echo "<song \n";
						echo "\tpath=\"".$dir_temp."/".$archivo."\"\n";
						echo "\ttitle=\"[[".strtoupper($dir_temp)."]] ".str_replace(".MP3","",strtoupper($archivo))."\"\n/>\n";
					}
				}
			}
		}
	}
	echo "</songs>";
?>