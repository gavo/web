<?php

	function serie1($n){
		$c = 0;
		$m = 0 ;
		$new = 1;
		while($c<$n){
			$c++;
			if($m<$new){
				$m++;
			}else{
				$m = 1;
				$new++;
				echo ' ';
			}
			echo $m;				
		}
	}

	function serie2($n){
		$c = 0;
		$num = 1;
		$den = 2;
		while($c<$n){
			$c++;
			echo $num.'/'.$den.' - ';
			$aux = $num;
			$num += $den;
			$den = $aux;
		}		
	}
	
	serie1(100);
	echo '<br>';
	serie2(20);
?>