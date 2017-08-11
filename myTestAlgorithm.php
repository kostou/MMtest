<?php

class myTestAlgorithm
{
    public $currentFilePointer;
    public $currentNumber;
    public $loopCounter;
    public $aRaw;
    public $aSorted;
    public $bNotSorted;
    public $startTime;
    public $executionTime;
    
    public function __construct($filePath, $filePathOut, $time_start) {
        $this->doProcess($filePath, $filePathOut, $time_start);
        $this->executionTime = new timeEnd($time_start);
        new writeToFile($filePathOut, $this->aSorted, $this->executionTime->timePassed);
        echo "Time passed: ".$this->executionTime->timePassed." Seconds";
    }

    
    public function doProcess($filePath,$filePathOut,$time_start)
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
        //$executionTime = $this->timeEnd($time_start);
        //echo "Time passed: ".$executionTime." Seconds";
    }
}

