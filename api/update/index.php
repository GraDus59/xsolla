<?php

use lib\classes\api\Rest;
use lib\classes\Check;

require_once __DIR__ . '/../../lib/header.php';

$id = $_GET['ID'];
$sku = $_GET['SKU'];
// not required
$title = $_GET['title'];
$type = $_GET['type'];
$price = $_GET['price'];
$description = $_GET['description'];

/** @var Check $Check */
$data = $Check->required([$id, $sku], 'ID OR SKU');

if (isset($id)) {
    $where_find = 'id';
    $result['ID'] = $Check->isNum($data, 'ID');
}

if (isset($sku)) {
    $where_find = 'sku';
    $result['SKU'] = $Check->isString($data, 'SKU');
}

$title = $Check->isString($title, 'title');
$type = $Check->isNum($type, 'type');
$price = $Check->isNum($price, 'price');
$description = $Check->isString($description, 'description');

$API = new Rest();

$API->update($where_find, $data, $title, $description, $type, $price);