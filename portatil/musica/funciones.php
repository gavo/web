<?php		
	function dameURL(){
		return "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	function botonesArtistas(){	
	$ant = 0;
	$pant = "";
	$pfin = "";
	$fin = 0;
	$cont = 0;
	$k = 0;
	echo "<table><tr>";	
	$directorio = opendir(".");
		while ($archivo = readdir($directorio)){		
			if (is_dir($archivo) && $archivo!="." && $archivo!=".."){
				if($cont ==0){
					$ant = $fin+1;
					$pant = $archivo;
				}
				$fin = $fin+1;
				$pfin = $archivo;
				if($cont == 21){
					if($k==8){
						echo "</tr>";
						echo "<tr>";
						$k = 0;
					}							
					echo "<td>\n";
					echo "<div id='sobreponer'><img src='base.jpg' width='35'  height='17'/>\n";
					echo "\t<label class='letra'>".strtoupper(substr($pant,0,1)."-".substr($pfin,0,1))."</label>\n";
					echo "\t<a href='index.php?i=".$ant."&f=".$fin."' target='_self'>\n";
					echo "\t<img class='sobre' src='mascara.png' width='35' height='17'/></a>\n";							
					echo "</div></td>\n";	
					$cont = -1;
					$k++;
				}
				$cont++;					
			}
		}
		
		if($k==8){
			echo "</tr>";
			echo "<tr>";
			$k = 0;
		}				
		echo "<td><div id='sobreponer'><img src='base.jpg' width='35'  height='17'/>\n";
		echo "\t<label class='letra'>".strtoupper(substr($pant,0,1)."-".substr($pfin,0,1))."</label>\n";
		echo "\t<a href='index.php?i=".$ant."&f=".$fin."' target='_self'>\n";
		echo "\t<img class='sobre' src='mascara.png' width='35' height='17'/></a>\n";							
		echo "</div></td>\n";
		echo "</tr></table>";	
	}
	
	function mostrarArtistas($i,$f){
		echo "<table>";
		$directorio = opendir(".");
		$cont = 1;
		while($archivo = readdir($directorio)){
			if (is_dir($archivo) && $archivo!="." && $archivo!=".."){
				if($cont >= $i && $cont <= $f){
					echo "<tr><td><div id='sobreponer'><img src='fm.png' width='300'  height='16'/>\n";
					echo "\t<label class='letra'>".strtoupper($archivo)."</label>\n";
					echo "\t<a href='index.php?play=".$archivo."'target='_self'>\n";
					echo "\t<img class='sobre' src='mascara.png' width='300' height='16'/></a>\n";							
					echo "</div></td></tr>\n";
				}				
				$cont = $cont + 1;
			}
		}
		echo "</table>";
		echo '<table><td valing = "buttom"><form method="post" action="index.php">
				Buscar Tema: <input type="text" name="q" value=""/>
				<input type="submit" name="submit" value="Buscar"/> </form></td></table>';
		
	}
?>