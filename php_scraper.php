<?php

$PATH = 'benchmarks/SPECjvm2008/results/gc/';
ini_set('memory_limit', '-1');
//Data Object
$GC = [];

//Regexes
$rLabels = '/\[(?<label>\w+)\s?: (?<from>\d+(.\d+)?)K->(?<to>\d+(.\d+)?)K\((?<total>\d+(.\d+)?)K\)(, (?<ltime>\d+(.\d+)?) secs)?/';
$rGCTime = '/\], (?<gctime>\d+(.\d+)?) secs\]/';
$rTime = '/\[Times: user=(?<user>\d+(.\d+)?) sys=(?<sys>\d+(.\d+)?), real=(?<real>\d+(.\d+)?) secs\]/';
$rGCmem = '/\] (?<from>\d+(.\d+)?)K->(?<to>\d+(.\d+)?)K\((?<total>\d+(.\d+)?)K\)(, (?<gctime>\d(\.\d+)?) secs)?/';
$rHeapLabel = '/(?<label>(\w+ )+) +total (?<total>\d+(.\d+)?)K, used (?<used>\d+(\.\d+)?)K/';
$rHeapSub = '/(?<name>(\w+ +)+)(?<size>\d+(\.\d+)?)K, +(?<percent>\d+(\.\d+)?)%/';
$rFullGC = '/\[Full GC/';
$rTimeStamp = '/^(?<stamp>\d+(\.\d+)?):/';
$rG1GC = '/(\d+(\.\d+)?): \[(?!GC concurrent).+, (?<gctime>\d+(\.\d+)?) secs/';
$rG1Heap = '/Heap: (?<from>\d+(\.\d+)?)(?<funit>\w)\((\d+(\.\d+)?)(\w)\)->(?<to>\d+(\.\d+)?)(?<tunit>\w)\((?<total>\d+(\.\d+)?)(?<totalunit>\w)\)/';

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
	$counts = [];
	
	//Open File
	$f = fopen($PATH . $file, "r");
	//echo $PATH . $file . "\n";
	
	//in heap info
	$heap = false;

	//make heap object
	$h = [];
	$label = null;

	//final timestamp
	$finalTimeStamp = null;

	//Loop through lines of file
	while(! feof($f)){
		$line = fgets($f);

		//get last timestamp
		if(preg_match($rTimeStamp, $line, $matches)){
			$finalTimeStamp = $matches['stamp'];
		}
	
		//If not GC line, move on
		if(!preg_match('/GC/', $line)){
			if($heap){
				if(preg_match('/^ \w/', $line)){
					if(preg_match($rHeapLabel, $line, $matches)){
						$label = $matches['label'];
						$h[$label] = [
							'total' => $matches['total'],
							'used' => $matches['used']
						];
					}
				}else if(preg_match('/^  \w/', $line)){
					if(preg_match($rHeapSub, $line, $matches)){
						$h[$label][$matches['name']] = [
							'size' => $matches['size'],
							'percent' => $matches['percent']
						];
					}
				}
			}else{
				if(preg_match('/^Heap/', $line, $matches)){
					$heap = true;
				}
			}

			//continue;
		}

		/* 
			Find GC Info in line
		*/
		
		//make run object
		$r = [];
	
		if($com == 'UseG1GC'){
			
			$info = [];

			/*if(preg_match($rG1GC, $line, $matches)){
				$info['gctime'] = $matches['gctime'];
			}*/

			if(preg_match($rG1Heap, $line, $matches)){
				//echo "match\n";
				//check units and convert to K
				if($matches['funit'] == 'M'){
					$matches['from'] = $matches['from'] * 1000.0;
				}
				if($matches['tunit'] == 'M'){
					$matches['to'] = $matches['to'] * 1000.0;
				}
				if($matches['totalunit'] == 'M'){
					$matches['total'] = $matches['total'] * 1000.0;
				}

				$info['from'] = $matches['from'];
				$info['to'] = $matches['to'];
				$info['total'] = $matches['total'];
				
			}

			if(sizeof($info) > 0)
				$r['info'] = $info;

			if(sizeof($r) > 0)
				array_push($obj['gc_runs'], $r);

			continue;
		}

		if(preg_match_all($rLabels, $line, $matches)){

			foreach($matches['label'] as $k => $label){
				$r[$label] = [
					'from' 	=> $matches['from'][$k],
					'to'	=> $matches['to'][$k],
					'total'	=> $matches['total'][$k],
					'time' 	=> $matches['time'][$k],
				];

				//increment counter for label
				if(!isset($counts[$label])){
					//initailize it
					$counts[$label] = 1;
				}else{
					$counts[$label]++;
				}
			}
			
		}

		$info = [];

		if(preg_match($rFullGC, $line)){
			$info['full'] = true;
		}

		if(preg_match($rGCTime, $line, $matches)){
			$info['gctime'] = $matches['gctime'];
		}

		if(preg_match($rGCmem, $line, $matches)){
			$info['from'] = $matches['from'];
			$info['to'] = $matches['to'];
			$info['total'] = $matches['total'];

			if($matches['gctime'] != null){
				$info['gctime'] = $matches['gctime'];
			}
		}

		if(preg_match($rTime, $line, $matches)){
			$info['user'] = $matches['user'];
			$info['sys'] = $matches['sys'];
			$info['real'] = $matches['real'];
		}

		if(sizeof($info) > 0)
			$r['info'] = $info;

		//append run object to array of runs
		if(sizeof($r) > 0)
			array_push($obj['gc_runs'], $r);

	}
	//Append heap info to object
	if(sizeof($h) > 0)
		$obj['heap'] = $h;

	//close file
	fclose($f);

	//Set stats in obj
	$obj['stats'] = [];
	foreach($counts as $l => $c){
		$obj['stats'][$l] = $c;
	}

	//set final timestamp
	$obj['stats']['final_time_stamp'] = $finalTimeStamp;

	//Break if you only want to run the frist file
	//break;
}

//make seperate files for each benchmark
foreach($GC as $k => $g){
	$f = fopen('data/' . $k . '.json', 'w');
	fwrite($f, json_encode($g));
	fclose($f);
}

?>
