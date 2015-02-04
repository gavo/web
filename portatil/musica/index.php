<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Musica del Callejon</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<?php 
header("Content-Type: text/html;charset=utf-8");
include("funciones.php")?>
</head>
<body>
	<div valign="top" align="center" width="7" > <table CELLPADDING=5 CELLSPACING=5 BORDER=5 BORDER bgcolor="#000000" align="center"><td align="center" WIDTH=350 HEIGHT=615 valign="top">
	<div valign="top" align="center" width="1"><a href="<?php echo "http://".$_SERVER['SERVER_NAME'];?>"><img src="logo.png" WIDTH=350 HEIGHT=50></a></div><br />
		<?php 
		if(!(isset($_GET['play'])) && !(isset($_POST['q']))){
			botonesArtistas();
			if((isset($_GET['i'])&&(isset($_GET['f'])))){				
				$i = $_GET['i'];				
				$f = $_GET['f'];
			}else{
				$i = 1;
				$f = 22;
			}
			mostrarArtistas($i,$f);
		}else{
			if((isset($_POST['q']))){
				?>
                <table><td>
				<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" 
					id="repro" 
					codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" 
					border="0" width="330" 	height="508">
					<param name="movie" value="Player.swf">
					<param name="quality" value="High">
					<embed src="Player.swf?lista=lista.php?buscar=<?php echo $_POST['q'];?>
                	"pluginspage=http://www.macromedia.com/go/getflashplayer" 
					type="application/x-shockwave-flash" 
					name="obj1" width="330" height="508"
				></object></td></table>
                <form><input type="button" value="volver atrás" name="volver atrás2" onclick="history.back()" /></form>
        <?php				
			}else{
		?>
        	<table><td>
				<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" 
					id="repro" 
					codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" 
					border="0" width="330" 	height="508">
					<param name="movie" value="Player.swf">
					<param name="quality" value="High">
					<embed src="Player.swf?lista=lista.php?lista=<?php echo $_GET['play'];?>
                	"pluginspage=http://www.macromedia.com/go/getflashplayer" 
					type="application/x-shockwave-flash" 
					name="obj1" width="330" height="508"
				></object></td></table>
                <form><input type="button" value="volver atrás" name="volver atrás2" onclick="history.back()" /></form>
        <?php	
		}}
		?>
   </td></table></div>
</body>
</html>