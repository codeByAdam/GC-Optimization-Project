<?php

$PATH = 'benchmarks/SPECjvm2008/results/gc/';

//Data Objects
$GC = [
	'DefNew' => [

	],
];

//Regexes
$rDefNew = '/(?<flagTime>\d+(.\d+)?): \[GC\d+(.\d+): \[DefNew: (?<from>\d+(.\d+)?)K->(?<to>\d+(.\d+)?)K\((?<total>\d+(.\d+)?)K\), (?<time>\d+(.\d+)?) secs] (?<GCfrom>\d+(.\d+)?)K->(?<GCto>\d+(.\d+)?)K\((?<GCtotal>\d+(.\d+)?)K\), (?<GCtime>\d+(.\d+)?) secs\] \[Times: user=(?<userTime>\d+(.\d+)?) sys=(?<sysTime>\d+(.\d+)?), real=(?<realTime>\d+(.\d+)?) secs\]/';

$files = scandir($PATH);
foreach($files as $file) {

	$cDefNew = 0;
	$cPSYoungGen = 0;
	$cPSOldGen = 0;
	$cPSPermGen = 0;
	
	//Don't open . and .. dirs
	if($file[0] == "." || $file == ".."){
		continue;
	}

	//Open File
	$f = fopen($PATH . $file, "r");
	echo $PATH . $file . "\n";
	
	//Loop through lines of file
	while(! feof($f)){
		$line = fgets($f);

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

		if(preg_match($rDefNew, $line, $matches)){
			//print_r($matches);
			array_push($GC['DefNew'], [
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
				'realTime' => $matches['realTime'],
			]);
		}

	}

	//close file
	fclose($f);

	$GC = json_encode($GC);
	$GC = json_decode($GC, JSON_PRETTY_PRINT);

	//print_r($GC);

	printf("DefNew: %d\n", $cDefNew);
	printf("PSYoungGen: %d\n", $cPSYoungGen);
	printf("PSOldGen: %d\n", $cPSOldGen);
	printf("PSPerGen: %d\n", $cPSPermGen);

	//break;
}


?>
