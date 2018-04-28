<?php

$PATH = 'benchmarks/SPECjvm2008/results/gc/';

//Data Object
$GC = [];

//Regexes
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
		$isGCRun = false;

		//Iterate counts
		if(preg_match('/DefNew/', $line)){
			$cDefNew++;
			$isGCRun = true;
		}
		if(preg_match('/PSYoungGen/', $line)){
			$cPSYoungGen++;
			$isGCRun = true;
		}
		if(preg_match('/PSOldGen/', $line)){
			$cPSOldGen++;
			$isGCRun = true;
		}
		if(preg_match('/PSPermGen/', $line)){
			$cPSPermGen++;
			$isGCRun = true;
		}

		if(preg_match($rDefNew, $line, $matches)){
			//print_r($matches);
			array_push($obj['gc_runs'], [
				'flagTime' => $matches['flagTime'],
				'from' => $matches['from'],
				'to' => $matches['to'],
				'total' => $matches['total'],
				'GCfrom' => $matches['GCfrom'],
				'GCto' => $matches['GCto'],
				'GCtotal' => $matches['GCtotal'],
				'GCtime' => $matches['GCtime'],
				'userTime' => $matches['userTime'],
				'sysTime' => $matches['sysTime'],
				'realTime' => $matches['realTime']
			]);
		}

		if($isGCRun){
			$rc++;
		}
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
	//$GC = json_decode($GC, JSON_PRETTY_PRINT);

	//print_r($GC);

	

	//break;
}


?>
