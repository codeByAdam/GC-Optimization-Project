<?php

$PATH = 'benchmarks/SPECjvm2008/results/gc/';

$FILE = 'CMSParallelRemarkEnabled_scimark.fft.large';

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