<?php
$PATH = 'data/';
$files = scandir($PATH);

$benchmarks = [];

foreach($files as $file) {
    $f = explode('.json', $file);
    array_push($benchmarks, $f[0]);
}

$b = json_encode($benchmarks);

print $b;

?>