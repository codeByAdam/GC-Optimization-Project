<?php
$PATH = 'data/';
ini_set('memory_limit', '-1');
$files = scandir($PATH);
$times = [];
$stamps = [];
$avgs = [];
$numBench = sizeof($files) - 2;

foreach($files as $file){
    $f = explode('.json', $file);

    if($file[0] == "."){
        continue;
    }

    $str = file_get_contents($PATH . $file);

    $json = json_decode($str, true);

    foreach($json as $alg => $d){

        if(!isset($times[$alg])){
            $times[$alg] = 0;
            $stamps[$alg] = 0;
        }

        foreach($d['gc_runs'] as $h){
            $times[$alg] += $h['info']['gctime'];
        }

        $stamps[$alg] += $d['stats']['final_time_stamp'];
        
        
    }
    //var_dump($frequency);
    
}
$x = [];
$y = [];
$avg_stamps = [];
$thr = [];
foreach($times as $alg => $counts){
    $avg[$alg] = $counts / $numBench;
    $avg_stamps[$alg] = $stamps[$alg] / $numBench;
    // to get throughput subtract from 100
    $thr[$alg] = (($avg[$alg] / $avg_stamps[$alg]) * 100.0);

    array_push($x, $alg);
    array_push($y, $thr[$alg]);
}

print json_encode($x);
print json_encode($y);

