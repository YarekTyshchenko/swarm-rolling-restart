<?php
ini_set('max_execution_time', -1);
header("Content-Type: text/plain");
//ini_set("output_buffering", 0);
$i = 0;
ob_start();
if ($_GET['sleep']) {

    $t = time();

    while(true) {
        $i++;
        //if (time() - $t > 30) {
            echo("Runnning version ". $_ENV['APPLICATION_VERSION'].PHP_EOL);
            echo "i = $i".PHP_EOL;
            echo PHP_EOL;
            flush();
            ob_flush();
        //}
        usleep(1000);
    }

}

echo("Runnning version ". $_ENV['APPLICATION_VERSION']);
ob_end_flush();
