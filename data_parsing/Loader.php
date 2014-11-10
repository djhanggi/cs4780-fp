<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

function autoload ($class_name) {
    $class_path = preg_replace('/_/', '/', $class_name) . '.php';
    include "$class_path";
    return $class_path;
}

spl_autoload_register('autoload');