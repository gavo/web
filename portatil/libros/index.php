<?php 
	include("funciones.php");
	if(isset($_POST['dir']))
		$dir=$_POST['dir'];
	else
		$dir='.';
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Documento sin título</title>
	<link href="style.css" rel="stylesheet">
    <script type="text/javascript" src="www/jquery.min.js"></script>
<script type="text/javascript" src="www/chili-1.7.pack.js"></script>
<script type="text/javascript" src="www/jquery.media.js"></script>
<script>
    $(function() {
        $('a.media').media({width:1000, height:520});
    });
</script>
</head>
<body>
	<div class="container">
        <header>
            <div align="center" ><img src="www/LOGO.png"/> </div>
        </header>
        <div class="sidebar1">
            <ul class="nav">
			<?php
                listar_directorios_ruta($dir);
            ?>
            </ul>
        </div>
        <article class="content"><div align="center">
			<?php
			if(!isset($_POST['pdf']))
        		listar_pdf($dir);
			else{?>
				<a class="media" href="<?php echo $dir.'/'.$_POST['pdf'];?>">VIRTUALIZACION</a></div><br><br><div id="footer">
<script src="urchin.js" type="text/javascript"></script>
<script type="text/javascript">
_uacct = "UA-850242-2";
urchinTracker();
</script>

			<?php }
            ?>
            </div>
        </article>
        <footer>
            <p align="center">Este footer</p>
        </footer>
  	</div>
</body>
</html>
