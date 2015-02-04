<?php
	if($_GET["down"]<>""){
		$down = $_GET["down"];
		function download($down){
			$down = str_replace(" ","%20",$down);
			$down = str_replace("xlx",$codexxx,$down);
			return "http://".$_SERVER['SERVER_NAME']."/musica/".$down;
		}
		@header("Content-Type: audio/mpeg3");
		@@header('Content-Disposition: attachment; filename="'.$_GET["nombre"].' - [ElCallejon.CoM].mp3"');
		@readfile(download($down));
	}else{
		print "<script> location.href='".$_SERVE['SERVER_NAME']."'; </script>";
	}
?>