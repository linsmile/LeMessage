<?php
require __DIR__ . '/config.php';
use LeMessage\IM\Message;

$message = new Message($lm);

//发送文字消息
$response = $message->sendText('test', 1, '你好吗？？');
print_r($response);

//发送图片消息

//先上传图片
$LeUpload = new Storage($lm);
$image  = $LeUpload->aws_upload('/Users/alex/ic_launcher.png', 'image', 'png', 'ic_launcher.png', 150, 150, 0 );

print_r($image);
//发消息
$response = $message->sendImage('test', 1, $image);
print_r($response);


//获取消息列表  方向是：seq_id  从大到小  取小于 seq_id 的消息
$response = $message->pull('test', 1, 0, 0, 15);
print_r($response);

//拉第二页  seq_id 传上一页，最后一个  offset 传 0  , pagesize 传 15
$response = $message->pull('test', 1, 30, 0, 15);
print_r($response);


//获取新消息列表  方向是:  seq_id  从小到大  取大于seq_id 的消息
$response = $message->latest('test', 1, 30, 0, 15);
print_r($response);
