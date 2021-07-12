<?php

use lib\classes\api\Rest;
use lib\classes\Check;

require_once __DIR__ . '/../../lib/header.php';

$sku = $_GET['SKU'];

/** @var Check $Check */
$Check->required($sku, 'SKU');

$sku = $Check->isString($sku, 'SKU');

$API = new Rest();

$API->info($sku);