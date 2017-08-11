<?php

class bubblesort
{
    public $currentFilePointer;
    public $currentNumber;
    public $loopCounter;
    public $aRaw;
    public $aSorted;
    public $bSorted;
    public $startTime;
    public $executionTime;
    public $max;
    
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
            $this->aRaw[] = $this->currentNumber;
            //$this->loopCounter++;
            //echo "filePointer: ".$this->currentFilePointer."\n";
            //echo "current number: ".$this->currentNumber."\n";
            //echo "loop counter: ".$this->loopCounter."\n";
            
        }
        
        $this->max = count($this->aRaw);

        while (!$this->bSorted)
        {
            $bThisIterationSwappedAny = false;
//            foreach ($this->aRaw as $key => $value)
            
            for ($i=0; $i<$this->max; $i++)
            {
                if (isset($this->aRaw[$i+1])&&$this->aRaw[$i]>$this->aRaw[$i+1])
                {
                    $tmpGreater = $this->aRaw[$i];
                    $this->aRaw[$i]=$this->aRaw[$i+1];
                    $this->aRaw[$i+1]=$tmpGreater;
                    $bThisIterationSwappedAny = true;
                }
            }
            if ($bThisIterationSwappedAny===false)
            {
                $this->bSorted = true;
                $this->aSorted = $this->aRaw;
                break;
            }
        }
        //print_r($this->aSorted);
        //$executionTime = $this->timeEnd($time_start);
        //echo "Time passed: ".$executionTime." Seconds";
    }
}

