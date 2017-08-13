<?php

namespace MMtest\Kostas;

class writeToFile
{
    
    private $fileHandle;
    
    public function __construct($filePath,&$aSorted,$executionTime,$class) {
        
        $this->fileHandle = fopen($filePath, "w+");
        if (!$this->fileHandle)
        {
            customError(E_USER_ERROR, "Could not open file", __FILE__, __LINE__);
            exit;
        }
        
        $datetime = date('H:i:s.u');
        fwrite($this->fileHandle, "Last run: ".$datetime.PHP_EOL);
        fwrite($this->fileHandle, "Algorithm (class used): ".substr(strrchr($class, "\\"), 1).PHP_EOL);
        fwrite($this->fileHandle, "Time passed: ".$executionTime." Seconds".PHP_EOL);
        fwrite($this->fileHandle, "Peak memory usage: ".(memory_get_peak_usage(false)/1024/1024)." MB".PHP_EOL);
        $lastkey = count($aSorted)-1;
        $commaCharacter=",";
        foreach ($aSorted as $key => $number)
        {
            if ($key==$lastkey)
            {
                $commaCharacter="";
            }
            fwrite($this->fileHandle, $number.$commaCharacter);
            if (MICROSECONDS>0)
            {
               usleep(MICROSECONDS); 
            }
        }
        
        fclose($this->fileHandle);
    }
}

        
?>

