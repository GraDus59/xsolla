<?php

use lib\classes\Check;

header('Content-Type: application/json; charset=utf-8');

if (empty($_GET['token'])) {
    die(json_encode(['error' => 'Token is empty']));
}

if ($_GET['token'] == '') {
    die(json_encode(['error' => 'Token is null']));
}

require_once __DIR__ . '/autoload.php';

$Check = new Check();