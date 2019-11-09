<?php
require __DIR__ . '/config.php';
use LeMessage\IM\Chat;

$chat = new Chat($lm);
$user = 'test';

//获取会话详情
$response = $chat->detail('test',1);
print_r($response);

//获取全部会话列表
$response =  $chat->listAll('test');
print_r($response);

$user_list = [
    'test',
    'test2',
];
$title = '订单1';
$unique_key = 'order_id_1';
//创建一个会话
$response =  $chat->create($user_list,  $title,  $unique_key);
print_r($response);