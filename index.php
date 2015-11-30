<?php
require __DIR__ . '/vendor/autoload.php';

use Yaren\Chat\Database\Model;
use Yaren\Core\JsonDecoder as JSON;

$jsonDecoder = new JSON();
$model = new Model($jsonDecoder);

