<?php

class writeToFile
{
    public function __construct($filePath,$aSorted,$executionTime) {
        $datetime = date('H:i:s.u');
        file_put_contents($filePath, "Last run: ".$datetime.PHP_EOL);
        file_put_contents($filePath, "Time passed: ".$executionTime." Seconds".PHP_EOL);
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

