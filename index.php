<?php
require_once 'errorHandling.php';
require_once 'config.php';


$className = "";
if (isset($argv[1]))
{
    $className = $argv[1];
}

if (file_exists("./Algorithms/".$className.".php"))
{
    include_once "./Algorithms/".$className.".php";
}
 else 
{
    customError(E_USER_ERROR, "File ".$className.".php was not found", __FILE__, __LINE__);
    exit;
}

if (class_exists('MMtest\\Kostas\\'.$className)) {
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
    $className = 'MMtest\\Kostas\\'.$className;
    $oProcessor = new $className($filePath,$filePathOut,$time_start);
} 
elseif (trim($className==""))
{
    echo "Please specify function name\n";
}
else {
    echo "Class ". $className. " does not exist\n";
}
?>
