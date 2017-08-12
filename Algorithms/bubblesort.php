<?php

namespace MMtest\Kostas;

class bubblesort
{
    public $currentFilePointer;
    public $currentNumber;
    public $loopCounter;
    public $aRaw = array();
    public $aSorted = array();
    public $bSorted = FALSE;
    public $startTime;
    public $executionTime;
    public $max;
    
    public function __construct($filePath, $filePathOut, $time_start) {
        $this->doProcess($filePath, $filePathOut, $time_start);
        $this->executionTime = new timeEnd($time_start);
        new writeToFile($filePathOut, $this->aSorted, $this->executionTime->timePassed,__CLASS__);
        echo "Time passed: ".$this->executionTime->timePassed." Seconds";
    }

    
    public function doProcess($filePath,$filePathOut,$time_start)
    {
        $oFileOpen = new \fileOpen($filePath);
        $fileHandle = $oFileOpen->getHandle();
        while (!feof($fileHandle))
        {
            $this->currentFilePointer = ftell($fileHandle);
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
            $bThisIterationSwappedAny = FALSE;
//            foreach ($this->aRaw as $key => $value)
            
            for ($i=0; $i<$this->max; $i++)
            {
                if (isset($this->aRaw[$i+1])&&$this->aRaw[$i]>$this->aRaw[$i+1])
                {
                    $tmpGreater = $this->aRaw[$i];
                    $this->aRaw[$i]=$this->aRaw[$i+1];
                    $this->aRaw[$i+1]=$tmpGreater;
                    $bThisIterationSwappedAny = TRUE;
                }
            }
            if ($bThisIterationSwappedAny===FALSE)
            {
                $this->bSorted = true;
                $this->aSorted = $this->aRaw;
                break;
            }
        }
        fclose($fileHandle);
    }
}

