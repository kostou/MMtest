<?php

namespace MMtest\Kostas;

class fileOpen
{
    private $fileHandle;
    
    public function __construct($filePath) {
        $this->fileHandle = fopen($filePath, "rb");
        if (!$this->fileHandle)
        {
            customError(E_USER_ERROR, "Could not open file", __FILE__, __LINE__);
            exit;
        }
    }
    
    public function getHandle()
    {
        return $this->fileHandle;
    }
}

