<?php 
	session_start();
	include("datos.php");
	include($topPage); 
 	include($cabecera);
	include($funciones);
	
?>
<div id="contenido"><center>
    <form method="post" action="buscar.php">
    	Tema a Buscar : <input type="text" name="q" value="<?php if(isset($_POST['q'])) echo $_POST['q']?>"/>
        <input type="submit" name="submit" value="Buscar"/> 
    </form>
  	<?php		
		if(!isset($_POST['q'])){
			echo '<h2>Videos Mas Vistos</h2>';
			$consulta = "SELECT visto.v c,tipo,id_vid,titulo,descripcion,dir,img,uploader,activo FROM material INNER JOIN visto ON video = id_vid WHERE activo =1 GROUP BY video ORDER BY c DESC LIMIT 0,20;";	
		}else{
			echo '<h2>Buscando: '.$_POST['q'].'</h2>';
			$consulta = "SELECT * FROM material WHERE titulo LIKE '%".mysql_real_escape_string($_POST['q'])."%' OR descripcion LIKE '%".mysql_real_escape_string($_POST['q'])."%';";	
		}		
		mostrarMaterial($consulta);
		echo '</center>';
	?>  
</div>
<?php include($piePagina); ?>