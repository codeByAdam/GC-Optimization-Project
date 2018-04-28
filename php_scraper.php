<?php

$PATH = 'benchmarks/SPECjvm2008/results/gc/';

//Data Object
$GC = [];

//Regexes
$rLabels = '/\[(?<label>\w+)\s?: (?<from>\d+(.\d+)?)K->(?<to>\d+(.\d+)?)K\((?<total>\d+(.\d+)?)K\)(, (?<ltime>\d+(.\d+)?) secs)?/';
$rGCTime = '/\], (?<gctime>\d+(.\d+)?) secs\]/';
$rTime = '/\[Times: user=(?<user>\d+(.\d+)?) sys=(?<sys>\d+(.\d+)?), real=(?<real>\d+(.\d+)?) secs\]/';
/*$l = '15.189: [GC15.189: [DefNew: 37544K->4148K(37568K), 0.0114770 secs]15.200: [Tenured: 95846K->95862K(95872K), 0.0081260 secs] 100126K->99994K(133440K), [Perm : 5103K->5103K(21248K)], 0.0197350 secs] [Times: user=0.02 sys=0.01, real=0.02 secs] ';
if(preg_match_all($rLabels, $l, $m)){
	print_r($m);
}*/

$rDefNew = '/(?<flagTime>\d+(.\d+)?): \[GC\d+(.\d+): \[DefNew: (?<from>\d+(.\d+)?)K->(?<to>\d+(.\d+)?)K\((?<total>\d+(.\d+)?)K\), (?<time>\d+(.\d+)?) secs] (?<GCfrom>\d+(.\d+)?)K->(?<GCto>\d+(.\d+)?)K\((?<GCtotal>\d+(.\d+)?)K\), (?<GCtime>\d+(.\d+)?) secs\] \[Times: user=(?<userTime>\d+(.\d+)?) sys=(?<sysTime>\d+(.\d+)?), real=(?<realTime>\d+(.\d+)?) secs\]/';

$files = scandir($PATH);
foreach($files as $file) {

	//Don't open . and .. dirs
	if($file[0] == "." || $file == ".."){
		continue;
	}

	//Get benchmark name and GC algorithm
	$names = explode("_", $file);
	$ben = $names[1];
	$com = $names[0];
	
	//Create Object to store benchmark data
	if(!isset($GC[$ben])){
		$GC[$ben] = [];
	}
	if(!isset($GC[$ben][$com])){
		$GC[$ben][$com] = [];
	}

	//Nickname it $obj so can be uses easier
	$obj = &$GC[$ben][$com];

	//make array for runs
	$obj['gc_runs'] = [];
	
	//Set counters
	$cDefNew = 0;
	$cPSYoungGen = 0;
	$cPSOldGen = 0;
	$cPSPermGen = 0;
	
	//Open File
	$f = fopen($PATH . $file, "r");
	//echo $PATH . $file . "\n";
	
	//set run count
	$rc = 0;

	//Loop through lines of file
	while(! feof($f)){
		$line = fgets($f);
	
		//If not GC line, move on
		if(!preg_match('/GC/', $line)){
			continue;
		}

		//Iterate counts
		if(preg_match('/DefNew/', $line)){
			$cDefNew++;
		}
		if(preg_match('/PSYoungGen/', $line)){
			$cPSYoungGen++;
		}
		if(preg_match('/PSOldGen/', $line)){
			$cPSOldGen++;
		}
		if(preg_match('/PSPermGen/', $line)){
			$cPSPermGen++;
		}

		/* 
			Find GC Info in line
		*/
		
		//make run object
		$r = [];

		if(preg_match_all($rLabels, $line, $matches)){

			foreach($matches['label'] as $k => $label){
				$r[$label] = [
					'from' 	=> $matches['from'][$k],
					'to'	=> $matches['to'][$k],
					'total'	=> $matches['total'][$k],
					'time' 	=> $matches['time'][$k],
				];
			}
			
		}

		if(preg_match($rGCTime, $line, $matches)){
			$r['gctime'] = $matches['gctime'];
		}

		if(preg_match($rTime, $line, $matches)){
			$r['user'] = $matches['user'];
			$r['sys'] = $matches['sys'];
			$r['real'] = $matches['real'];
		}

		//append run object to array of runs
		array_push($obj['gc_runs'], $r);

	}

	//close file
	fclose($f);

	//Set stats in obj
	$obj['stats'] = [
		'DefNew_count' => $cDefNew,
		'PSYoungGen_count' => $cPSYoungGen,
		'PSOldGen_count' => $cPSOldGen,
		'PSPermGen_count' => $cPSPermGen
	];

	$f = fopen('GCObject.json', 'w');
	fwrite($f, json_encode($GC));
	fclose($f);
	
	//Break if you only want to run the frist file
	break;
}


?>
