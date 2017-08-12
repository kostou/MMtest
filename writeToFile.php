<?php

namespace MMtest\Kostas;

class writeToFile
{
    public function __construct($filePath,$aSorted,$executionTime,$class) {
        $datetime = date('H:i:s.u');
        file_put_contents($filePath, "Last run: ".$datetime.PHP_EOL);
        file_put_contents($filePath, "Algorithm (class used): ".substr(strrchr($class, "\\"), 1).PHP_EOL, FILE_APPEND);
        file_put_contents($filePath, "Time passed: ".$executionTime." Seconds".PHP_EOL, FILE_APPEND);
        file_put_contents($filePath, "Peak memory usage: ".(memory_get_peak_usage(false)/1024/1024)." MB".PHP_EOL, FILE_APPEND);
        
        $lastkey = count($aSorted)-1;
        $commaCharacter=",";
        foreach ($aSorted as $key => $number)
        {
            if ($key==$lastkey)
            {
                $commaCharacter="";
            }
            file_put_contents($filePath, $number.$commaCharacter, FILE_APPEND);
        }
    }
}

        
?>

