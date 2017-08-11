<?php

set_time_limit(0);
define('FILE1', './files/input/random_100.txt');
define('FILE2', './files/input/random_10000.txt');
define('FILE3', './files/input/random_10000000.txt');
define('FILE1out', './files/output/sorted_100.txt');
define('FILE2out', './files/output/sorted_10000.txt');
define('FILE3out', './files/output/sorted_10000000.txt');

require_once 'timeEnd.php';
require_once 'writeToFile.php';

?>
