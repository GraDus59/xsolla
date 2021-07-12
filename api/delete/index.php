<?php

use lib\classes\api\Rest;
use lib\classes\Check;

require_once __DIR__ . '/../../lib/header.php';

$id = $_GET['ID'];
$sku = $_GET['SKU'];

/** @var Check $Check */
$data = $Check->required([$id, $sku], 'ID OR SKU');

if (isset($id)) {
    $result['ID'] = $Check->isNum($data, 'ID');
}

if (isset($sku)) {
    $result['SKU'] = $Check->isString($data, 'SKU');
}

$API = new Rest();

$API->delete($result);