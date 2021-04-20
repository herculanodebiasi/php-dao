<?php

spl_autoload_register(function(string $className):void {
    $classFolder = 'src'.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $fullName = getcwd().DIRECTORY_SEPARATOR."$classFolder.php";

    if(file_exists($fullName) === true) {
        @require_once($fullName);
    }
});