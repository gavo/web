<!DOCTYPE html>
<html lang="es"> 
	<head>
		<title>Reproductor en HTML5</title>
		<meta charset="utf-8"/>
		<link href='http://fonts.googleapis.com/css?family=Viga|Titan+One|Passion+One|Cabin+Condensed:700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/tools/jquery-1.7.2.min.js"></script>
		<script src="js/tools/jquery.tools.min.js"></script>
		<script type="text/javascript" src="js/theduxer.js"></script>
	</head>
	<body>	
		<section id="player" data-autoplay="1" data-loop="1">	
        
        	<div id="logo"><img id="logo" src="img/LOGO.png"></div>		
			<section id="player">			
				<section id="controls">
					<section id="songTitle">
						<span>Titulo de la Cancion</span>
					</section>
					<section id="playertrols">					
						<div id="plauseStop">
							<div id="plause"></div>
							<div id="stop"></div>
						</div>
						<div id="progressBar">
							<div id="timeLoaded"></div>
							<div id="timePlayed"></div>
                            <div id="currentTime">
								<time>00:00</time>
							</div>	
						</div>		
					</section>
					<section id="volumeTime">
						<input type="range" min="0" max="1" step="0.1" value="0.5"/>
						<div id="timeStatus">
							<time id="played">00:00</time>
							<span>/</span>
							<time id="totalTime">00:00</time>
						</div>
					</section>
				</section>
				<section id="playlist">
					<section id="tracks">
						<article class="track trackPlaying" data-source="Panda - Amnistia.mp3">
							<span>Panda - Amnistia</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - Amnistia Unplugged MTV.mp3">
							<span>Panda - Amnistia Unplugged MTV</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - cuando no es como debiera ser acustica.mp3">
							<span>Panda - cuando no es como debiera ser acustica</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - Amnistia.mp3">
							<span>Panda - Amnistia</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - Amnistia Unplugged MTV.mp3">
							<span>Panda - Amnistia Unplugged MTV</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - cuando no es como debiera ser acustica.mp3">
							<span>Panda - cuando no es como debiera ser acustica</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - Amnistia.mp3">
							<span>Panda - Amnistia</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - Amnistia Unplugged MTV.mp3">
							<span>Panda - Amnistia Unplugged MTV</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - cuando no es como debiera ser acustica.mp3">
							<span>Panda - cuando no es como debiera ser acustica</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - Amnistia.mp3">
							<span>Panda - Amnistia</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - Amnistia Unplugged MTV.mp3">
							<span>Panda - Amnistia Unplugged MTV</span>
						</article>
						<article class="track trackPlaying" data-source="Panda - Procedimiento para llegar a un comun acuerdo.mp3">
							<span>Panda - Procedimiento para llegar a un comun acuerdo</span>
						</article>
					</section>
				</section>
			</section>
		</section>
    </body>
</html>