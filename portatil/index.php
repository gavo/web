<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Mi Compu</title>
<link href="style.css" rel="stylesheet" />
<script>
	function esempio(str){searchWin = window.open(str,'esempio','scrollbars=no, menubar=no, directories=no, location=no, resizable=no, copyhistory=no, statusbar=no, width=400, height=660, status=no, location=no, toolbar=no');}
</script>

</head>	
<body>	
    <div class="logo"><img src="www/logo.png"/></div>
	<div id="contenedor">
        <div id="contenidos">
            <div id="columna"><a href="javascript:esempio('musica');" onmouseover="'; return true"><IMG SRC="www/musica.jpg" id="resaltar"></a></div>
            <div id="columnaCentral">
                <FORM method=GET action="http://www.google.com.bo/search" target="_blank">
                    <a HREF="http://www.google.com.bo/" target="_blank">
                    <IMG SRC="www/Google_Safe.png" class="logos" ALT="Google" align="absmiddle"></a>
                    <INPUT TYPE=text name=q value="Buscar en Google"
						onfocus="if(this.value=='Buscar en Google') this.value='';"
						onblur="if(this.value=='') this.value='Buscar en Google';" 
					 />
                    <INPUT TYPE=hidden name=hl value=es>
					<INPUT type=submit name=btnG VALUE="Buscar Tema" />
				</FORM>
            </div>
            <div id="columna"><a href="video" target="_blank"><IMG SRC="www/videos.jpg" id="resaltar"></a></div>
        </div>
        <div id="contenidos">
            <div id="columna"><a href="http://facebook.com" target="_blank"><IMG SRC="www/facebook.jpg" id="resaltar"></a></div>
            <div id="columnaCentral">
            	<FORM method=GET action="http://www.google.com.bo/search" target="_blank">
                    <a href="http://www.google.com.bo/imghp" target="_blank">
                    <img src="www/imagen.png" class="logos" alt="Google" align="absmiddle"></a>
                    <INPUT TYPE=text name=q value="Buscar Imagen"
						onfocus="if(this.value=='Buscar Imagen') this.value='';" 
						onblur="if(this.value=='') this.value='Buscar Imagen';" 
					/>
                    <INPUT TYPE=hidden name=tbm value=isch>
					<INPUT type=submit name=btnG VALUE="Buscar Imagen">
				</FORM>
            </div>
            <div id="columna"><a href="http://hotmail.com" target="_blank"><IMG SRC="www/hotmail.jpg" id="resaltar"></a></div>
        </div>
        <div id="contenidos">
            <div id="columna"><a href="libros" target="_blank"><IMG SRC="www/libros.jpg" id="resaltar"></a></div>
            <div id="columnaCentral">
            	<form method="get" action="http://www.youtube.com/results" target="_blank">                
                <a HREF="http://youtube.com/" target="_blank">
                <IMG SRC="www/youtube.png" class="logos" ALT="Google" align="absmiddle"></a>
					<INPUT TYPE=text name=q value="Buscar Video"
						onfocus="if(this.value=='Buscar Video') this.value='';" 
						onblur="if(this.value=='') this.value='Buscar Video';" 
					/>
					<input type="hidden" name="hl" value="es" /> 
					<input name="btnG" value="Buscar Video" type="submit" />
				</form>	
            </div><div id="columna"><a href="fotos" target="_blank"><IMG SRC="www/fotos.jpg" id="resaltar"></a></div>
        </div>
        <div id="contenidos">
            <div id="columna"><a href="rreducativos" target="_blank"><IMG SRC="www/rreducativos.jpg" id="resaltar"></a></div>
            <div id="columnaCentral">
            	<form method="get" action="http://es.wikipedia.org/w/index.php" target="_blank">                
                <a HREF="http://es.wikipedia.org/wiki/Wikipedia:Portada" target="_blank">
                <IMG SRC="www/wikipedia.png" class="logos" ALT="Google" align="absmiddle"></a>
					<INPUT TYPE=text name=search value="Buscar Informacion"
						onfocus="if(this.value=='Buscar Informacion') this.value='';" 
						onblur="if(this.value=='') this.value='Buscar Informacion';" 
					 />
					<input type="hidden" name="title" value="Especial%3ABuscar" /> 
					<input name="go" value="Buscar Informacion" type="submit" />
				</form>	
            </div> 
            <div id="columna"><a href="caleidoscopio" target="_blank"><IMG SRC="www/caleidoscopio.jpg" id="resaltar"></a></div>
        </div>
	</div>
</body>
</html>