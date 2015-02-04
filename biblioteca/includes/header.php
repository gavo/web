<div id="header">
</div>
<div id="menu">	
	<a href="<?php echo $host;?>">[Inicio]</a>&nbsp;&nbsp;    
    <a href="<?php echo $categorias;?>">[Categorias]</a>&nbsp;&nbsp;
    <a href="<?php echo $buscar;?>">[Buscar]</a>&nbsp;&nbsp;
    <?php   
		if(isset($_SESSION['user']))
   			echo '<a href="'.$subir.'">[Subir Contenido]</a>&nbsp;&nbsp';
		
        if(!isset($_SESSION['user'])){
			echo '<a href="'.$identificarse.'">[Identificarse]</a>';
		}else{
			echo '<a href="utils/salir.php">'.$_COOKIE['nombre'].' [Desconectarse]</a>';
		}
	?>
</div>