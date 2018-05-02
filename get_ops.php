<?php
$alg = ["UseSerialGC",
        "UseParallelGC",
        "UseParallelOldGC",
        "UseConcMarkSweepGC",
        "UseParNewGC",
        "CMSParallelRemarkEnabled",
        "UseCMSInitiatingOccupancyOnly",
        "UseG1GC"];

$ben = ["startup.helloworld",
        "startup.compiler.compiler",
        //"startup.compiler.sunflow",
        "startup.compress",
        "startup.crypto.aes",
        "startup.crypto.rsa",
        "startup.crypto.signverify",
        "startup.mpegaudio",
        "startup.scimark.fft",
        "startup.scimark.lu",
        "startup.scimark.monte_carlo",
        "startup.scimark.sor",
        "startup.scimark.sparse",
        "startup.serial",
        //"startup.sunflow",
        "startup.xml.transform",
        "startup.xml.validation",
        "compiler.compiler",
        //"compiler.sunflow",
        "compress",
        "crypto.aes",
        "crypto.rsa",
        "crypto.signverify",
        "derby",
        "mpegaudio",
        "scimark.fft.large",
        "scimark.lu.large",
        "scimark.sor.large",
        "scimark.sparse.large",
        "scimark.fft.small",
        "scimark.lu.small",
        "scimark.sor.small",
        "scimark.sparse.small",
        "scimark.monte_carlo",
        "serial",
        //"sunflow",
        "xml.transform",
        "xml.validation"
    ];


$PATH = '/Users/adamordway/ownCloud/School/cs494/GCOP/benchmarks/control/results/';
ini_set('memory_limit', '-1');
$files = scandir($PATH);

$ops = [];

foreach($files as $file){

    if($file[0] == "." || $file == "gc"){
        continue;
    }

    $f = fopen($PATH . $file . "/" . $file . ".txt", "r");

    while(! feof($f)){
        $line = fgets($f);
        
        if(preg_match('/ (?<ops>\d+(\.\d+)?) ops\/m/', $line, $matches)){
            array_push($ops, $matches['ops']);
        }


    }
    
}

$count = 0;
$data = [];
foreach($alg as $a){
    foreach($ben as $b){
        //print $a . " " . $b . " " . $ops[$count++] . "\n";
        
        if(!isset($data[$a])){
            $data[$a] = [];
        }
        
        //print $ops[$count] . "\n";
        $data[$a][$b] = $ops[$count++];


    }
}

$traces = [];
$x = [];

$ass = [];

sort($ben);
sort($alg);

foreach($ben as $bench){
    array_push($x, $bench);
}

foreach($alg as $a) {

    $trace = [];

    $trace['x'] = $ben;

    $trace['y'] = [];

    //print "ALGORITHM: " . $a . "\n";
    foreach($ben as $b) {
        //print "  " . $b . ": " . $data[$a][$b] . "\n";
        array_push($trace['y'], $data[$a][$b]);
    }
    $trace['name'] = $a;
    $trace['type'] = 'bar';

    array_push($traces, $trace);
}



print json_encode($traces);

?>