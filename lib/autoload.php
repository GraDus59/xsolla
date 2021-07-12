<?php

spl_autoload_register('autoload');

function autoload($name)
{
    $arPath = explode("\\", $name);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/" . implode('/', $arPath) . '.php';
    require_once $path;
}