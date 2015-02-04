<?php
	include('db_conect.php');
	include('datos.php');
	function dameURL(){
		return "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	
	function getBit($value){
		if(($value % 2 == 0)||($value == 1))
			return array($value);
		else{
			$salida = null;
			$c = 0;
			$aux1 = 1;
			$aux = 0;
			while($aux1 < $value){
				$aux = $aux1;
				$aux1 = $aux1 * 2;
			}
			return array_merge(array($aux),getBit($value-$aux));
		}
	}
	
	function mostrarMaterial($consulta){			 
  		include("utils/db_conect.php");	
		$resultado = $mysqli->query($consulta);
		if($resultado){
			$cont = -1;
			echo "<center><table>";
			while($fila = $resultado->fetch_assoc()){	
				if($cont == -1 or $cont==5){
					if($cont==5)
						echo "</tr>";
					echo "<tr>";
					$cont = 1;
				}
				echo "<td>";
				echo "<div id='sobreponer'><img src='".$fila['img']."' width='180'  height='120'/>\n";
				echo "<label class='letra'>".$fila['titulo']."</label>\n";
				echo "<a href='ver.php?peli=".$fila['id_vid']."' target='_blank'>\n";
				if($fila['tipo']==1)
					echo "<img class='sobre' src='img/mascara.png' width='180' height='120'/></a>\n";	
				else
					echo "<img class='sobre' src='img/mascara1.png' width='180' height='120'/></a>\n";							
				echo "</div></td>\n";								
				$cont = $cont+1;									
			}
			echo "</table>";
		}
		$mysqli->close();	
	}
	function mostrarVideo($sql){
		include("db_conect.php");
		$resultado = $mysqli->query($sql);
		$id_up = 0;
		$titulo ='';
		$descripcion ='';
		$dir = '';
		$visto = 0;
		$id_vid = 0;
		while($fila = $resultado->fetch_assoc()){	
			$id_up = $fila['uploader'];
			$titulo = strtoupper($fila['titulo']);
			$descripcion = $fila['descripcion'];
			$dir = $fila['dir'];
			$id_vid = $fila['id_vid'];
		}
		$sql = "SELECT usuario FROM `user` WHERE id='".mysql_real_escape_string($id_up)."'";
		$resultado = $mysqli->query($sql);
		$uploader ='';
		while($fila = $resultado->fetch_assoc()){
			$uploader = ucfirst($fila['usuario']);
		}
		$sql = "SELECT SUM(v) usuario FROM visto WHERE video='".mysql_real_escape_string($id_vid)."';";
		$resultado = $mysqli->query($sql);
		while($fila = $resultado->fetch_assoc())
			$visto = $fila['usuario'];
		echo "<h2>".$titulo."</h2>";
		if($visto == 0)
			echo "Video Subido por: <a href='usuario.php?user=".$id_up."'>".$uploader."</a><br>Este video esta siendo visualizado por primera vez<br />";
		else if($visto ==1)
			echo "Video Subido por: <a href='usuario.php?user=".$id_up."'>".$uploader."</a><br>Este video fue visualizado solo una vez<br />";
		else if($visto > 1)
			echo "Video Subido por: <a href='usuario.php?user=".$id_up."'>".$uploader."</a><br>Este video fue visualizado ".$visto." veces<br />";
		echo "Este video fue catalogado como:<br />".$descripcion."<br>";
		echo "<h2><a href='http://".$_SERVER['SERVER_NAME']."/descargar.php?vid=".$id_vid."' target='_self'>[Descargar]</a></h2>";	
		echo '<video id="medio"  preload="auto" width="640" height="360" controls="controls" data-setup="{}" src="'.$dir.'"></video></center><br />';
		$mysqli->close();
		return $id_vid;
	}	
	
	function mostrarPDF($sql){
		include("db_conect.php");
		$resultado = $mysqli->query($sql);
		$id_up = 0;
		$titulo ='';
		$descripcion ='';
		$dir = '';
		$visto = 0;
		$id_vid = 0;
		while($fila = $resultado->fetch_assoc()){	
			$id_up = $fila['uploader'];
			$titulo = strtoupper($fila['titulo']);
			$descripcion = $fila['descripcion'];
			$dir = $fila['dir'];
			$id_vid = $fila['id_vid'];
		}
		$sql = "SELECT usuario FROM `user` WHERE id='".mysql_real_escape_string($id_up)."'";
		$resultado = $mysqli->query($sql);
		$uploader ='';
		while($fila = $resultado->fetch_assoc()){
			$uploader = ucfirst($fila['usuario']);
		}
		$sql = "SELECT SUM(v) usuario FROM visto WHERE video='".mysql_real_escape_string($id_vid)."';";
		$resultado = $mysqli->query($sql);
		while($fila = $resultado->fetch_assoc())
			$visto = $fila['usuario'];
		echo "<h2>".$titulo."</h2>";
		if($visto == 0)
			echo "Documento Subido por: <a href='usuario.php?user=".$id_up."'>".
				 $uploader."</a><br>Este Documento esta siendo visualizado por primera vez<br />";
		else if($visto ==1)
			echo "Documento Subido por: <a href='usuario.php?user=".$id_up."'>".
				 $uploader."</a><br>Este Documento fue visualizado solo una vez<br />";
		else if($visto > 1)
			echo "Documento Subido por: <a href='usuario.php?user=".$id_up."'>".
				 $uploader."</a><br>Este Documento fue visualizado ".$visto." veces<br />";
			
		echo "Este Documento fue catalogado como:<br />".$descripcion."<br><br>";
		echo '<div id="main"><a class="media" href="'.$dir.'">'.$titulo.'</a></div>';
		$mysqli->close();
		return $id_vid;
	}
	
	function contarVisita($id_vid,$usuario){
		include("db_conect.php");
		$sql = "SELECT id FROM videoteca.user WHERE usuario='".mysql_real_escape_string($usuario)."'";
		$resultado = $mysqli->query($sql);
		$id = 0;
		while($fila = $resultado->fetch_assoc())
			$id = $fila['id'];
		$sql = 	"INSERT INTO `videoteca`.`visto`(`usuario`,`video`,`v`) VALUES ('".mysql_real_escape_string($id).
				"','".mysql_real_escape_string($id_vid)."','0');";
		$resultado = $mysqli->query($sql);
		$sql =  "UPDATE `videoteca`.`visto` SET v=v+1 WHERE `usuario`='".mysql_real_escape_string($id).
				"' AND `video`='".mysql_real_escape_string($id_vid)."';";
		$resultado = $mysqli->query($sql);
		$mysqli->close();		
	}	
	function mostrarCategorias(){
		include("db_conect.php");
		$sql = "SELECT categoria.*,COUNT(asoc.id_vid) cant FROM categoria INNER JOIN asoc 
				ON categoria.id_cat = asoc.id_cat GROUP BY categoria.id_cat order by nombre;";
		$resultado = $mysqli->query($sql);
		echo '<hgroup><h5>';
		$cont = 0;
		while($fila = $resultado->fetch_assoc()){
			echo '<a href="http://'.$_SERVER['SERVER_NAME'].'/categorias.php?cat='.$fila['id_cat'].
			     '">'.$fila['nombre'].' ['.$fila['cant'].']</a>';	
				 
			$cont = $cont+1;
			if($cont == 7){
				$cont = 0;
				echo '</h5><h5>';
			}else{
				echo '&nbsp;&nbsp;&nbsp';
			}
		}
		echo '</h5></hgroup>';		
		$mysqli->close();
	}
	function mostrarCategoria($id_cat){
		include("db_conect.php");
		$sql ="SELECT COUNT(asoc.id_vid)cant FROM asoc WHERE id_cat = '".mysql_real_escape_string($id_cat)."';";
		$resultado = $mysqli->query($sql);
		$cant = 0;
		while($fila = $resultado->fetch_assoc()){
			$cant = $fila['cant'];
		}
		
		if($cant==0){
			$sql = "SELECT id_cat FROM asoc GROUP BY id_cat ORDER BY RAND() LIMIT 1;";	
			$resultado = $mysqli->query($sql);	
			while($fila = $resultado->fetch_assoc()){
				$id_cat = $fila['id_cat'];
			}
		}
		$sql = "SELECT nombre FROM categoria WHERE id_cat ='".mysql_real_escape_string($id_cat)."';";
		$resultado = $mysqli->query($sql);
		$nombre = "";	
		while($fila = $resultado->fetch_assoc()){
			$nombre = $fila['nombre'];
		}
		echo "<h4>Categoria: ".$nombre."</h4>";
		$sql = "SELECT material.* FROM material INNER JOIN asoc ON asoc.id_vid = material.id_vid WHERE asoc.id_cat='".mysql_real_escape_string($id_cat)."';";
		mostrarMaterial($sql);	
		
		$mysqli->close();
	}
	function listarCategorias(){
		include("db_conect.php");							
		$consulta = "SELECT * FROM categoria ORDER BY id_cat desc";
		$resultado = $mysqli->query($consulta);
		if($resultado){
			while($fila = $resultado->fetch_assoc()){	
				echo "<option value='".$fila['id_cat']."'>".$fila['nombre']."</option>\n";									
			}
		}
		$mysqli->close();
	}
	function esUsuario($id){
		include('db_conect.php');
		$consulta = "SELECT COUNT(id) b FROM `user` WHERE id ='".mysql_real_escape_string($id)."';";
		$resultado = $mysqli->query($consulta);
		$salida = 0;
		if($resultado){
			while($fila = $resultado->fetch_assoc()){	
				$salida = $fila['b'];									
			}
		}		
		$mysqli->close();
		if($salida == 1)
			return true;
		else
			return false;
	}
	function getUsuario($id_us){
		include('db_conect.php');
		$consulta = "SELECT usuario FROM `user` WHERE id ='".mysql_real_escape_string($id_us)."';";
		$resultado = $mysqli->query($consulta);
		$salida = '';
		if($resultado){
			while($fila = $resultado->fetch_assoc()){	
				$salida = $fila['usuario'];									
			}
		}
		$mysqli->close();
		return $salida;
	}
	function datosUsuario($id_us){
		include('db_conect.php');
		$consulta = "SELECT * FROM `user` WHERE id ='".mysql_real_escape_string($id_us)."';";
		$resultado = $mysqli->query($consulta);
		if($resultado){
			while($fila = $resultado->fetch_assoc()){
				echo '<b>Usuario Registrado el:</b> '.$fila['registrado'].'<br>';	
				echo '<b>Nombre Completo:</b> '.$fila['nombre'].' '.$fila['apellido'].'<br>';
				if($fila['activo']==0)
					echo 'Usuario no Activado</b><br>';
				if($fila['activo']==1)
					echo 'Usuario Activo</b><br>';
				if($fila['activo']==2)
					echo 'Usuario Baneado</b><br>';							
			}
		}
		$consulta = "SELECT SUM(v) vio FROM visto WHERE usuario ='".mysql_real_escape_string($id_us)."';";
		$resultado = $mysqli->query($consulta);
		if($resultado){
			while($fila = $resultado->fetch_assoc()){
				echo 'Videos vistos por el usuario: '.$fila['vio'].'<br>';
			}
		}
		$consulta = "SELECT COUNT(id_vid) sub FROM video WHERE uploader ='".mysql_real_escape_string($id_us)."';";
		$resultado = $mysqli->query($consulta);
		if($resultado){
			while($fila = $resultado->fetch_assoc()){
				echo '<h1>Videos Subidos por el usuario: '.$fila['sub'].'</h1>';
			}
		}
		$consulta = "SELECT * FROM material WHERE uploader = '".mysql_real_escape_string($id_us)."';";
		mostrarMaterial($consulta);
		$mysqli->close();
	}
	function getID(){
		include('db_conect.php');
		$consulta = "SELECT id FROM `user` WHERE usuario ='".mysql_real_escape_string($_COOKIE['nombre'])."';";	
		$salida = 0;
		$resultado = $mysqli->query($consulta);
		if($resultado){
			while($fila = $resultado->fetch_assoc()){
				$salida = $fila['id'];
			}
		}
		$mysqli->close();
		return $salida;
	}
	function getNombreUsuario(){
		include('db_conect.php');
		$consulta = "SELECT nombre FROM `user` WHERE id ='".mysql_real_escape_string(getID())."';";	
		$salida = '';
		$resultado = $mysqli->query($consulta);
		if($resultado){
			while($fila = $resultado->fetch_assoc()){
				$salida = $fila['nombre'];
			}
		}
		$mysqli->close();
		return $salida;
	}
	function getApellidoUsuario(){
		include('db_conect.php');
		$consulta = "SELECT apellido FROM `user` WHERE id ='".mysql_real_escape_string(getID())."';";	
		$salida = '';
		$resultado = $mysqli->query($consulta);
		if($resultado){
			while($fila = $resultado->fetch_assoc()){
				$salida = $fila['apellido'];
			}
		}
		$mysqli->close();
		return $salida;
	}
	function existeUsuario($user){
		include('db_conect.php');
		$consulta = "SELECT id FROM `user` WHERE usuario ='".mysql_real_escape_string($user)."';";	
		$salida = 0;
		$resultado = $mysqli->query($consulta);
		if($resultado){
			while($fila = $resultado->fetch_assoc()){
				$salida = $fila['id'];
			}
		}
		$mysqli->close();
		if($salida==0)
			return false;
		else
			return true;
	}	
?>