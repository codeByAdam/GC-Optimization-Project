<?php
$PATH = 'data/';
ini_set('memory_limit', '-1');
$files = scandir($PATH);
$times = [];
$stamps = [];
$avgs = [];
$numBench = sizeof($files) - 2;

$marks = [];

foreach($files as $file){
    $f = explode('.json', $file);
    $f = $f[0];

    if($file[0] == "."){
        continue;
    }

    $str = file_get_contents($PATH . $file);

    $json = json_decode($str, true);

    if(!isset($marks[$f])){
        $marks[$f] = [];
    }

    foreach($json as $alg => $d){

        if(!isset($marks[$f][$alg])){
            $marks[$f][$alg] = [];
            $marks[$f][$alg]['gc_time'] = 0;
        }

        foreach($d['gc_runs'] as $run => $r){
            $marks[$f][$alg]['gc_time'] += $r['info']['gctime'];
        }

        $marks[$f][$alg]['total_time'] = $d['stats']['final_time_stamp'];

    }

    
}

$traces = [];
$x = [];

foreach($marks as $bench => $m){
    array_push($x, $bench);
}

foreach($marks as $bench => $m){
    $y = [];
    foreach($m as $alg => $d){
        array_push($y, 100 - ($d['gc_time'] / $d['total_time'] * 100));
    }
    array_push($traces, [
        'x' => $x,
        'y' => $y
    ]);
}

print json_encode($traces);

/*$x = [];
$y = [];
$avg_stamps = [];
$thr = [];
foreach($times as $alg => $counts){
    $avg[$alg] = $counts / $numBench;
    $avg_stamps[$alg] = $stamps[$alg] / $numBench;

    $thr[$alg] = 100.0 - (($avg[$alg] / $avg_stamps[$alg]) * 100.0);

    array_push($x, $alg);
    array_push($y, $thr[$alg]);
}*/

