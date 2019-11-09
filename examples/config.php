<?php

require __DIR__ . '/../autoload.php';

use LeMessage\LeMessage;

$appKey = 'test';
$masterSecret = 'test';

$lm = new LeMessage($appKey, $masterSecret);
