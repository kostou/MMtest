<?php
//This is a very basic error handling. 
//customError() should write to the database (asynchronously via some sort of caching mechanism)
//instead of just printing to the screen..
set_error_handler('customError');
set_exception_handler('exceptionHandler');
register_shutdown_function( "fatalHandler" );
error_reporting(E_ALL);

function customError($errno, $errstr, $errfile, $errline) {
    echo "Error: ".$errstr. " at ".$errfile." line: ".$errline."(error number: ".$errno.")\n";
}

function exceptionHandler($e)
{
    customError(E_ERROR, $e->getMessage(), $e->getFile(), $e->getLine());
}

function fatalHandler()
{
    $error = error_get_last();
    if ($error['type'] === E_ERROR) { 
        customError($error['type'], $error['message'], $error['file'], $error['line']);
    }
}