<?php
require __DIR__ . '/config.php';
use LeMessage\IM\Group;
use LeMessage\IM\Storage;

$group = new Group($lm);

$owner = 'user_0';
$name = 'jiguang';
// $members = ['user_1', 'user_2', 'user_3'];
$members = [];
$mems = ['user_4', 'user_5'];
$desc = 'jiguang gtoup';

echo "create group: \n";
$owner = 'test';
$user_list = ['test2',  'test3', 'test4'];
$title  = 'test_group';
$response = $group->create($owner, $user_list, $title, '');
print_r($response);
echo "\n";

$chat_id = $response['data']['chat_id'];

echo "invite group: \n";
$user_list = ['test5', 'test6'];
$response = $group->invite($owner, $chat_id, $user_list);
print_r($response);
echo "\n";

echo "kick group: \n";
$user_list = ['test5', 'test6'];
$response = $group->kick($owner, $chat_id, $user_list);
print_r($response);
echo "\n";

echo "quit group: \n";
$user_list = ['test5', 'test6'];
$response = $group->quit($owner, $chat_id, 'test4');
print_r($response);
echo "\n";

echo "update group: \n";
$response = $group->update('test4', $chat_id, '新的标题', '');
print_r($response);
echo "\n";


echo "update group: \n";

//先上传图片
$LeUpload = new Storage($lm);
$image  = $LeUpload->aws_upload('/Users/alex/ic_launcher.png', 'image', 'png', 'ic_launcher.png', 150, 150, 0 );

print_r($image);

$response = $group->update('test4', $chat_id, '新的标题', $image['name']);
print_r($response);
echo "\n";