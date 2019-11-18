<?php

require __DIR__ . '/../autoload.php';

use LeMessage\LeMessage;

$appKey = 'test';
$masterSecret = 'test';
$options  =   [
    'logFile'  => '', //错误日志文件路径
];
$lm = new LeMessage($appKey, $masterSecret, $options);
