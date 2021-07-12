<?php

header('Content-Type: charset=utf-8');

require_once __DIR__ . '/../../lib/autoload.php';

if (empty($_GET['login']) or $_GET['login'] == '') {
    die('Login is empty');
}

if (empty($_GET['password']) or $_GET['password'] == '') {
    die('Password is empty');
}

$API = new \lib\classes\api\Rest();

$API->auth($_GET['login'], $_GET['password']);