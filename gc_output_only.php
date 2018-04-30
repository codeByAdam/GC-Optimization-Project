<?php

$PATH = 'benchmarks/SPECjvm2008/results/gc/';

$FILE = 'UseParallelGC_compiler.compiler';

$f = fopen($PATH . $FILE, "r");

while(! feof($f)){
    $line = fgets($f);
    if(preg_match('/Application time/', $line) || preg_match('/Total time/', $line)){
        continue;
    }

    echo $line . "\n";
}

fclose($f);

?>