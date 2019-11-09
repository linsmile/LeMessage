<?php
require __DIR__ . '/config.php';
use LeMessage\IM\Friend;

$friend = new Friend($lm);
$user = 'test';
$friends = ['test1', 'test2', 'test3', 'test4', 'test5'];

echo "list friends: \n";
$response = $friend->listAll($user);
print_r($response);
echo "\n";

echo "add friends: \n";
$response = $friend->add($user, $friends);
print_r($response);
echo "\n";

echo "list friends: \n";
$response = $friend->listAll($user);
print_r($response);
echo "\n";


echo "remove friends: \n";
$response = $friend->delete($user, $friends);
print_r($response);
echo "\n";

echo "list friends: \n";
$response = $friend->listAll($user);
print_r($response);
echo "\n";


echo "request friends: \n";
$response = $friend->request($user, 'test6');
print_r($response);
echo "\n";

echo "approve friends: \n";
$response  =  $Friend->approve('test7',  'test', 1);
print_r($r);
print_r($response);
echo "\n";