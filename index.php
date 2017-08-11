<?php
set_time_limit(0);
define('FILE1', './files/input/random_100.txt');
define('FILE2', './files/input/random_10000.txt');
define('FILE3', './files/input/random_10000000.txt');
define('FILE1out', './files/output/sorted_100.txt');
define('FILE2out', './files/output/sorted_10000.txt');
define('FILE3out', './files/output/sorted_10000000.txt');
class fileProcessor
{
    public $currentFilePointer;
    public $currentNumber;
    public $loopCounter;
    public $aRaw;
    public $aSorted;
    public $bNotSorted;
    public $startTime;
    
    
    public function timeEnd($time_start)
    {
        $time_end = microtime(true);
        $timePassed = $time_end - $time_start;
        return $timePassed;
    }
    
    public function writeToFile($filePath,$aSorted,$executionTime)
    {
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
    
    public function test($filePath)
    {
        $fileHandle = fopen($filePath, "rb");
        if (!$fileHandle)
        {
            echo "Could not open file";
            exit;
        }
        while (!feof($fileHandle))
        {
            $this->currentFilePointer = ftell($fileHandle);  
            $this->currentNumber = stream_get_line($fileHandle, 1024, ",");
            
            //$this->loopCounter++;
            //echo "filePointer: ".$this->currentFilePointer."\n";
            //echo "current number: ".$this->currentNumber."\n";
            //echo "loop counter: ".$this->loopCounter."\n";
            
        }
    }
    
    public function test2($filePath,$filePathOut,$time_start)
    {
        $fileHandle = fopen($filePath, "rb");
        if (!$fileHandle)
        {
            echo "Could not open file";
            exit;
        }
        while (!feof($fileHandle))
        {
            $this->currentNumber = stream_get_line($fileHandle, 1024, ",");
            if(count($this->aSorted)==0)
            {
                $this->aSorted[] = $this->currentNumber;
            }
            else 
            {
                foreach ($this->aSorted as $key => $number)
                {
                    if (!isset($this->aSorted[$key-1])&&$this->currentNumber<$number)
                    {//If smaller than first element, make it first.
                        array_splice($this->aSorted, 0, 0, $this->currentNumber);
                        break;
                    }
                    if (isset($this->aSorted[$key-1])&&$this->currentNumber>$this->aSorted[$key-1]&&$this->currentNumber<$number)
                    {//If larger than previous element and smaller than current, put in between.
                        array_splice($this->aSorted, $key, 0, $this->currentNumber);
                        break;
                    }
                    if (!isset($this->aSorted[$key+1])&&$this->currentNumber>$number)
                    {//If larger than first element, make it last.
                        $this->aSorted[] = $this->currentNumber;
                        break;
                    }
                }
            }
            //$this->loopCounter++;
            //echo "filePointer: ".$this->currentFilePointer."\n";
            //echo "current number: ".$this->currentNumber."\n";
            //echo "loop counter: ".$this->loopCounter."\n";
            
        }
        //print_r($this->aSorted);
        $executionTime = $this->timeEnd($time_start);
        echo "Time passed: ".$executionTime." Seconds";
        $this->writeToFile($filePathOut, $this->aSorted,$executionTime);
    }
    
    public function bubbleSort($filePath)
    {
        $fileHandle = fopen($filePath, "rb");
        if (!$fileHandle)
        {
            echo "Could not open file";
            exit;
        }
        while (!feof($fileHandle))
        {
            $this->currentNumber = stream_get_line($fileHandle, 1024, ",");
            $this->aRaw[] = $this->currentNumber;
        }
        
        while($this->bNotSorted)
        {
            foreach ($this->aRaw as $key => $number)
            {
                
            }
        }
    }
}

$functionName = "";
if (isset($argv[1]))
{
    $functionName = $argv[1];
}

$oProcessor = new fileProcessor();
if (method_exists($oProcessor,$functionName)) {
    if (isset($argv[2]))
    {
        $fileSelector = $argv[2];
        if($fileSelector==1)
        {
            $filePath = FILE1;
            $filePathOut = FILE1out;
        }
        elseif($fileSelector==2)
        {
            $filePath = FILE2;
            $filePathOut = FILE2out;
        }
        elseif($fileSelector==3)
        {
            $filePath = FILE3;
            $filePathOut = FILE3out;
        }
        else 
        {
            echo "Please enter valid file selector (1-3)";
        }
    }
    $time_start = microtime(true);
    $oProcessor->{$functionName}($filePath,$filePathOut,$time_start);

} 
elseif (trim($functionName==""))
{
    echo "Please specify function name\n";
}
else {
    echo "Function ". $functionName. " does not exist\n";
}
?>
