<?php
spl_autoload_register('myAoutoLaoder');
function myAoutoLaoder($className)
{
$path='../classes/';
$extention='.class.php';
$fullpath=$path.$className.$extention;
include_once $fullpath;
if(!file_exists($fullpath))
{
    return false;
}
}
?>