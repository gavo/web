<?php 
	session_start();
	if(!isset($_SESSION['user']))
		die('Usted no esta autorizado para ver el contenido de esta pagina, por favor Ingrese con su Cuenta');	
	include("datos.php");
	include($topPage); 
 	include($cabecera);
	include($funciones);
?>
	<center><h1>Subir Contenido</h1>
	<div id="formulario"><center>
		<form action="subir2.php" method="post" enctype="multipart/form-data" name="form"> 
		Seleccione un Archivo: <input name="archivo" type="file" /><br> <br>
		<b>Informacion del video<b><br>
		Titulo :<input name="ttt" type="text" size="45" maxlength="100" value="">
		<select name='cat'><?php listarCategorias();?></select><br>
		Nueva Categoria:<input name="newCat" type="text" size=45 maxlength=15 onfocus="if(this.value=='(Solo si no Encontro una Categoria Apropiada)') this.value=''";
		onblur="if(this.value=='') this.value='(Solo si no Encontro una Categoria Apropiada)';" value='(Solo si no Encontro una Categoria Apropiada)'><font size=1> ( Maximo Permitido : 15 Caracteres )</font>
		<br><br><h5>Contenido del Video (Palabras claves para facilitar su Busqueda):</h5>
		<textarea name="comentarios" rows="6" cols="80"></textarea><br>
		<input name="submit" type="submit" id="boton" value="Subir Contenido" />
	</form></center><br>
</div><br>
<?php include($piePagina); ?>