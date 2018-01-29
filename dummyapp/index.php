<?php
ini_set('max_execution_time', -1);
header("Content-Type: text/plain");
//ini_set("output_buffering", 0);

//ob_start();
if ($_GET['sleep']) {

    $t = time();

    while(true) {
        //if (time() - $t > 30) {
            echo("Runnning version ". $_ENV['APPLICATION_VERSION']);
            echo PHP_EOL;
            //ob_flush();
        //}
        //sleep(1);
    }

}

echo("Runnning version ". $_ENV['APPLICATION_VERSION']);
//ob_end_flush();
