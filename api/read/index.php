<?php

use lib\classes\api\Rest;

require_once __DIR__ . '/../../lib/header.php';

$page = $_GET['page'];

$pagination = null;

if (isset($page) and is_numeric($page)) {
    $pagination = $Check->isNum($page);
}

$API = new Rest();

$API->read($pagination);