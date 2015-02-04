<?php 
	session_start();
	include("datos.php");
	include($topPage); 
 	include($cabecera);
	include($funciones);
?>
<div id="contenido">
    <h1> </h1>
  	<center><h1>Ultimo Material Subido a la WEB</h1></center>
  	<?php					
		mostrarMaterial("SELECT tipo,titulo, id_vid, img FROM material ORDER BY id_vid DESC LIMIT 0, 24;");
	?>
</div>
<?php include($piePagina); ?>