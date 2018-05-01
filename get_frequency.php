<?php
$PATH = 'data/';
ini_set('memory_limit', '-1');
$files = scandir($PATH);
$frequency = [];
$avgs = [];
$numBench = sizeof($files) - 2;
$stamps = [];
foreach($files as $file){
    $f = explode('.json', $file);

    if($file[0] == "."){
        continue;
    }

    $str = file_get_contents($PATH . $file);

    $json = json_decode($str, true);


    foreach($json as $alg => $d){
    
        if(!isset($frequency[$alg])){
            $frequency[$alg] = 0;
        }

        $frequency[$alg] += sizeof($d['gc_runs']);
        $stamps[$alg] += $d['stats']['final_time_stamp'];
        
    }
    //var_dump($frequency);
    
}
$x = [];
$y = [];
foreach($frequency as $alg => $counts){
    echo $stamps[$alg] / $numBench;
    echo "\n";
    $avg[$alg] = ($counts / $numBench) / (($stamps[$alg] / $numBench) / 60);
    array_push($x, $alg);
    array_push($y, $avg[$alg]);
}

var_dump($stamps);

print json_encode($x);
print json_encode($y);




?>