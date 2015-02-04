<?php
	function listar_directorios_ruta($ruta){
		$rt = opendir($ruta);
		if($ruta=="."){
			while ($file = readdir($rt)) {
				if (is_dir($ruta."/".$file) && $file!="." && $file!=".." && strtolower($file)!='www'){
					echo '<li><form method="post" action="">
					<input type="hidden" name="dir" value="'.$file.'">
					<INPUT id="linav" type=submit value="'.strtolower($file).'"></form></li>';
				}
			}
		}else{
			while ($file = readdir($rt)) {
				if (is_dir($ruta."/".$file) && $file!="." && $file!=".." && strtolower($file)!='www'){
					echo '<li><form method="post" action="">
					<input type="hidden" name="dir" value="'.$ruta.'/'.$file.'">
					<INPUT id="linav" type=submit value="'.strtolower($file).'"></form></li>';
				}
			}				
			echo '<li><form><INPUT id="linav" type=submit value="< ATRAS >" onclick=history.back()></form></li>';	
		}
	}
	
	function listar_pdf($ruta){
		$rt = opendir($ruta);
		while ($file = readdir($rt)) {
			if((!is_dir($ruta."/".$file)) && strtolower(substr($file,-4))==".pdf"){
				echo "<form  action='' method='post'>
						<input type='hidden' name='dir' value='".$ruta."'></input>
						<input type='submit' id='lpdf' name='pdf' value='".$file."'></form><br>";
					
			}
		}
		
	}
?>