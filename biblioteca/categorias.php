<?php 
	session_start();
	include("datos.php");
	include($topPage); 
 	include($cabecera);
	include($funciones);
?>

<div id="contenido">
	<center>
    <h1></h1>
  	<?php	
		mostrarCategorias();
		echo '<h1></h1>';	
		if(isset($_GET['cat']))			
			mostrarCategoria($_GET['cat']);
		else
			mostrarCategoria(-1);
	?> 
    </center>
</div>
<?php include($piePagina); ?>