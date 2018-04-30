<?php
$PATH = 'data/';
ini_set('memory_limit', '-1');
$files = scandir($PATH);
$heap = [];
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

        if(!isset($heap[$alg])){
            $heap[$alg] = 0;
        }

        foreach($d['heap'] as $h){
            $heap[$alg] += $h['used'];
        }
        
        
    }
    //var_dump($frequency);
    
}
$x = [];
$y = [];
foreach($heap as $alg => $counts){
    $avg[$alg] = $counts / $numBench;
    array_push($x, $alg);
    array_push($y, $avg[$alg]);
}

print json_encode($x);
print json_encode($y);




?>