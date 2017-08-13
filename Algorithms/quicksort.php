<?php

namespace MMtest\Kostas;

class quicksort
{
    public $currentFilePointer;
    public $currentNumber;
    public $loopCounter;
    public $aRaw;
    public $aSorted;
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
        $this->loopCounter = 1;
        $this->aRaw = new \SplFixedArray(($this->loopCounter));
        while (!feof($fileHandle))
        {
            $this->currentFilePointer = ftell($fileHandle);
            $this->currentNumber = stream_get_line($fileHandle, 1024, ",");
            $this->aRaw[$this->loopCounter-1] = $this->currentNumber;
            $this->loopCounter++;
            $this->aRaw->setSize(($this->loopCounter));
        }
        $this->aRaw->setSize(($this->loopCounter-1));
        $this->aSorted = new \SplFixedArray(count($this->aRaw));
        $this->aSorted = $this->sorting($this->aRaw);
        fclose($fileHandle);
    }
    
    private function sorting(&$aUnsorted)
    {
        if (count($aUnsorted)<=1)
        {//There is only one element, so this array partition is sorted..
            return $aUnsorted;
        }
        $pivotPoint = $aUnsorted[0];
        $aBeforePivotPoint = array();
        $aAfterPivotPoint = array();
        $aPivotPoint = array();
        foreach ($aUnsorted as $key => $value)
        {
            if ($value>$pivotPoint)
            {
                $aAfterPivotPoint[] = $value;
            }
            elseif ($value<$pivotPoint)
            {
                $aBeforePivotPoint[] = $value;
            }
            else
            {
                $aPivotPoint[] = $value;
            }
        }
        return array_merge($this->sorting($aBeforePivotPoint), $aPivotPoint, $this->sorting($aAfterPivotPoint));
    }
}

