<?php

use lib\classes\api\Rest;
use lib\classes\Check;

require_once __DIR__ . '/../../lib/header.php';

$title = $_GET['title'];
$type = $_GET['type'];
$price = $_GET['price'];
// not required
$description = $_GET['description'];

/** @var Check $Check */
$Check->required($title,'Titile');
$Check->required($type,'Type');
$Check->required($type,'Price');

$title = $Check->isString($title,'title');
$type = $Check->isNum($type,'type');
$price = $Check->isNum($price,'price');
$description = $Check->isString($description,'description');

$API = new Rest();

$API->create($title,$description,$type,$price);