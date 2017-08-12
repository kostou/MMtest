<?php

class fileOpen
{
    private $fileHandle;
    
    public function __construct($filePath) {
        $this->fileHandle = fopen($filePath, "rb");
        if (!$this->fileHandle)
        {
            echo "Could not open file";
            exit;
        }
    }
    
    public function getHandle()
    {
        return $this->fileHandle;
    }
}

