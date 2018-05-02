<?php
$PATH = 'data/';
ini_set('memory_limit', '-1');
$files = scandir($PATH);
$max = [];
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
    
        /*if(!isset($max[$alg])){
            $max[$alg] = 0;
        }

        foreach($d['gc_runs'] as $r){
            if($r['info']['to'] > $r['info']['from']){
                $max[$alg] += $r['info']['to'];
            }else{
                $max[$alg] += $r['info']['from'];
            }
        }*/
        if(!isset($max[$alg][$f[0]])){
            $max[$alg][$f[0]] = 0;
        }

        foreach($d['gc_runs'] as $r){
            if($r['info']['from'] > $max[$alg][$f[0]]){
                $max[$alg][$f[0]] = $r['info']['from'];
            }

            if($r['info']['to'] > $max[$alg][$f[0]]){
                $max[$alg][$f[0]] = $r['info']['to'];
            }
        }
    }
    //var_dump($frequency);
    
}

$sum = [];
$avg = [];

foreach($max as $alg => $d){
    if(!isset($sum[$alg])){
        $sum[$alg] = 0;
    }

    foreach($d as $c){
        $sum[$alg] += $c;
    }

    $avg[$alg] = $sum[$alg] / $numBench;

}

$p = [];
foreach($avg as $a){
    array_push($p, $a);
}

print(json_encode($p));

/*$x = [];
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
print json_encode($y);*/




?>