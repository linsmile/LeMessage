<?php
require __DIR__ . '/config.php';
use LeMessage\IM\User;
use LeMessage\IM\Storage;

$user = new User($lm);
$userinfo = [
    'username' => 'user_id_xxxx',
    'password'  =>  '123456',
    'nickname' => '用户昵称',
    'birthday' =>  '1970-01-01',
    'gender' => 0,
    'region' => '深圳',
    'address' => '南山',
    'signature' => '签名',
];
$response = $user->register($userinfo);
print_r($response);

//更新头像
$response = $user->show('user_id_xxxx');
print_r($response);

// 支持修改以下字段，不修改，可以不传，传空的话，就会修改为空
$userinfo = [
    'nickname' => '用户昵称',
    'birthday' =>  '1970-01-01',
    'gender' => 0,
    'region' => '深圳',
    'address' => '南山',
    'signature' => '签名',
];

//修改用户资料
$response = $user->update('user_id_xxxx', $userinfo);
print_r($response);


//修改密码
$response = $user->update_password('user_id_xxxx', '123456',  '111111');
print_r($response);


//修改头像 先上传头像
//先上传图片
$LeUpload = new Storage($lm);
$image  = $LeUpload->aws_upload('/Users/alex/ic_launcher.png', 'image', 'png', 'ic_launcher.png', 150, 150, 0 );

print_r($image);

//更新头像
$response = $user->update_avatar('user_id_xxxx', $image['name']);
print_r($response);

