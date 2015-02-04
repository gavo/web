<?php
	// directorio principal de la web
	$host = 'http://'.$_SERVER['SERVER_NAME'].'/';
	
	// subdirectorios
	$utils = $host.'utils/';
	$videoteca = $host;
	$topPage = 'includes/top_page.php';
	$cabecera = 'includes/header.php';
	$piePagina = 'includes/footer.php';
	$funciones = 'utils/funciones.php';
	$db = 'utils/db_conect.php';
	
	// archivos en directorio principal
	$usuario = $host.'usuario.php';
	$identificarse = $host.'identificarse.php';
	$estilo = $host.'style.css';
	
	// archivos en subdirectorio de videoteca
	$categorias = $videoteca.'categorias.php';
	$buscar = $videoteca.'buscar.php';
	$subir = $videoteca.'subir.php';
	$descargarVideo = $videoteca.'descargar.php';
	$subirVideo2 = $videoteca.'subir2.php';
	$verVideo = $videoteca.'ver.php';	
	$identificarse = $videoteca.'identificarse.php';
?>