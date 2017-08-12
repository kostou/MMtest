<?php

namespace MMtest\Kostas;

class timeEnd
{
    public $timePassed;
    
    public function __construct($time_start) {
        $time_end = microtime(true);
        $this->timePassed = $time_end - $time_start;
        return $this->timePassed;
    }
}
