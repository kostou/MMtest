<?php

namespace MMtest\Kostas;

class selectionSort
{
    public $currentFilePointer;
    public $currentNumber;
    public $loopCounter;
    public $aRaw = array();
    public $aSorted = array();
    public $startTime;
    public $executionTime;
    
    public function __construct($filePath, $filePathOut, $time_start) {
        $this->doProcess($filePath, $filePathOut, $time_start);
        $this->executionTime = new timeEnd($time_start);
        new writeToFile($filePathOut, $this->aSorted, $this->executionTime->timePassed,__CLASS__);
        echo "Time passed: ".$this->executionTime->timePassed." Seconds";
    }

    
    public function doProcess($filePath,$filePathOut,$time_start)
    {
        $oFileOpen = new fileOpen($filePath);
        $fileHandle = $oFileOpen->getHandle();
        while (!feof($fileHandle))
        {
            $this->currentFilePointer = ftell($fileHandle);
            $this->currentNumber = stream_get_line($fileHandle, 1024, ",");
            $this->aRaw[] = $this->currentNumber;
            if (MICROSECONDS>0)
            {
               usleep(MICROSECONDS); 
            }
        }
        
        foreach ($this->aRaw as $value)
        {
            $smallestValueKey = array_search(min($this->aRaw),$this->aRaw);
            $this->aSorted[] = $this->aRaw[$smallestValueKey];
            unset($this->aRaw[$smallestValueKey]);
            if (MICROSECONDS>0)
            {
               usleep(MICROSECONDS); 
            }
        }
        fclose($fileHandle);
    }
}

