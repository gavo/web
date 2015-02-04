var a;
var previous;
var aSource;
var aTitle;
var autoplay;
var totalTracks;
var previousTrackNum;
var ext;
var loop;

var currentTimeInfo;
var plause;
var playlistControl;
var progressBar;
var stop;
var songTitle;
var timeLoaded;
var timePlayed;
var totalTime;
var tracksSection;
var playing = false;
var trackSelector;
var volumeControl;
var lt;
var trackNum = 0; //Cancion que inicia
var vol = 1.0; //Volumen inicial
var maxlength = 65; // Maximo de caracteres para cada item de #tracks
$(function (){	
	//Crear Objeto Audio
	a = new Audio();
	a.preload = 'metadata';
	a.autoplay = 'false',
	// Asignar selector a variables	
	currentTimeInfo = $("#currentTime");
	plause = $("#plause");
	playlistControl = $("#playlistControl");
	progressBar = $("#progressBar");
	stop = $("#stop");
	songTitle = $("#songTitle");
	timeLoaded = $("#timeLoaded");
	timePlayed = $("#timePlayed");
	totalTime = $("#totalTime");
	tracksSection = $("#tracks");
	trackSelector = $(".track");
	volumeControl = $(":range");
	volumeControl.val(vol);
	//Otras Variables
	autoplay = $("#player").attr("data-autoplay");
	loop = $("#player").attr("data-loop");
	totalTracks = $(".track").size();

		//Agregar Eventos
		a.addEventListener('timeupdate',updateTime);
		a.addEventListener('ended',endSong);
		a.addEventListener('progress',loadingTime)
		a.addEventListener('loadedmetadata',metadata);
		a.addEventListener('error',error)
		//Renombrar items de #tracks
	renameTracksItems();

	//Configuración inicial inicial
	aSource = $(".track").eq(trackNum).attr("data-source");
	a.volume = vol;

	//Crea control de volumen
	volumeControl.rangeinput();

	//Se inicia reproduccion
	if(autoplay==1){
		previousTrackNum = trackNum;
		beforePlay();	
	}

	//Asignar eventos de objetos

		//Pausar o Reaunar reproduccion
	plause.click(function (){
		if(playing){
			a.pause();
			playing = false;
			plause.css('background','url(img/play.png)');
		}
		else{	
			if(autoplay == 0)
				beforePlay();
			else{
				a.play();
				playing = true;
				plause.css('background','url(img/pause.png)');
			}
		}
	});
		//Presionar boton STOP
	stop.click(function (){
		a.pause();
		a.currentTime = 0;
		playing = false;
		
		a.removeEventListener('canplay',letsPlay);

		timePlayed.css('width','0%');
		plause.css('background','url(img/play.png)');

	});

	$(":range").change(function (e,vl){
		a.volume = vl;
		vol = vl;
	});

		//Seleccionar Track
	trackSelector.click(function (){
		aSource = $(this).attr('data-source');

		var trackIndex = trackSelector.index(this);
		if((previous === aSource && playing == false) || previous !== aSource)
		{
			previousTrackNum = trackNum;
			trackNum = trackIndex;

			beforePlay();
		}		
	});

		//ProgressBar
	var positionP = progressBar.position();
	var topProgress = positionP.top - progressBar.height() + 10;
	var leftProgress = positionP.left;
	var barWidthP = progressBar.width();
	var ctWidth = currentTimeInfo.width();
	progressBar.bind({
		
		'click': function(e){			
			var pos = e.pageX - leftProgress;
			var newPos = (pos * a.duration) / barWidthP;

			if(newPos <= lt.end(0) && playing)
				a.currentTime = newPos;
		},
		'mousemove': function (e){
			
			var pos = e.pageX - leftProgress;
			var currentTime = pos * (a.duration) / barWidthP;
			var ctLeft = e.pageX - (ctWidth / 2)+'px';
			currentTimeInfo.css({
				'display':'block',
				'top':topProgress+'px',
				'left': ctLeft
			});

			currentTimeInfo.text(formatTime(currentTime));
		},
		'mouseout':function (){
			currentTimeInfo.css('display','none')
		}
	});

		//Ocultar  o mostrar Playlist
	playlistControl.click(function (){
		if(tracksSection.css('display') === 'block')
		{
			tracksSection.slideUp('fast');
			$(this).html('&#x25BC;');
		}
		else
		{
			tracksSection.slideDown('fast');
			$(this).html('&#x25B2;');
		}
	});
});

function renameTracksItems(){
	$(".track span").each(function (){
		var st = $(this).text();

		if(st.length > maxlength)
		{
			st = st.substring(0,maxlength);
			$(this).text(st+' ...');
		}
			
	});
}


function metadata(){
	var total = formatTime(a.duration);
	totalTime.text(total);
}

function beforePlay(){
	if(playing){
		a.pause();
		playing = false;
		plause.css('background','url(img/play.png')
		timeLoaded.css('width','0%');
		timePlayed.css('width','0%');
	}

	aTitle = trackSelector.eq(trackNum).text();
	songTitle.text('Loading...');

	trackSelector.eq(previousTrackNum).removeClass('trackPlaying');
	trackSelector.eq(trackNum).addClass('trackPlaying');

	a.src = aSource;
	a.load();

	a.addEventListener('canplay',letsPlay);
}

function letsPlay(){
	songTitle.text(aTitle);
	a.play();
	previous = aSource;
	playing = true;
	plause.css('background','url(img/pause.png)');
}

function updateTime(){
	var total = a.duration;
	var current = a.currentTime;

	var currentPercentage = (current * 100) / total;
	timePlayed.css('width',currentPercentage+'%');

	var ctText = formatTime(current);
	$("#played").text(ctText);

	if(lt.end(0) < total && !$.browser.opera){
		lt = a.buffered;
		loadingTime();
	}
}


function endSong(){

	a.pause();
	playing = false;
	
	a.removeEventListener('canplay',letsPlay);

	timePlayed.css('width','0%');
	timeLoaded.css('width','0%');
	plause.css('background','url(img/play.png)');

	previousTrackNum = trackNum;

	if(trackNum==(totalTracks-1) && loop == 1){

		if(trackNum<(totalTracks-1))
			trackNum++;
		else
			trackNum = 0;

		aSource = trackSelector.eq(trackNum).attr('data-source');
		beforePlay();
	}
	else if(trackNum<(totalTracks-1)){
	
		trackNum++;

		aSource = trackSelector.eq(trackNum).attr('data-source');
		beforePlay();
	}
}


function loadingTime(){
	lt = a.buffered;
	var loadedTime = lt.end(0);
	var tl = ( (loadedTime * 100)/a.duration );

	timeLoaded.css('width',tl+'%');
}


function formatTime(time)
{
	var s = Math.floor(time%60);
	var min = Math.floor(time/60);
	var timeText;

	if(s<10)
		s = '0'+s;
	
	if(min<10)
		min = '0'+min;

	timeText = min+':'+s;

	return timeText;
}

function error()
{
	if(a.error.code == 4)
		errorString = 'Codec Error';
	else
	

	songTitle.text('Error Loading Files: '+errorString);
}