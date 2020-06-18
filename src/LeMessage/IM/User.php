<?php
namespace LeMessage\IM;
use LeMessage\IM;

class User extends IM {

    public function register(array $user)
    {
        if(empty($user['uid']) || empty($user['password']) || empty($user['nickname']))
        {
            throw new \Exception('uid/password/nickname 均不能为空', -1);
        }
        $uri = self::API_DOMAIN . '/?ct=user&ac=reg';

        return $this->post($uri, $user);
    }

    public function batch_register(array $user_list)
    {
        foreach($user_list as $key=>$user)
        {
            if(empty($user['uid']) || empty($user['password']) || empty($user['nickname']))
            {
                $index = $key + 1;
                throw new \Exception("第 {$index} 个用户参数错误, uid/password/nickname 均不能为空", -1);
            }
        }
        $uri = self::API_DOMAIN . '/?ct=user&ac=batch_reg';

        return $this->post($uri, $user_list);
    }

    public function show($uid)
    {
        $uri = self::API_DOMAIN . '/?ct=user&ac=show';
        $query = ['_from_uid' => $uid];
        return $this->post($uri, $query);
    }

    public function update($uid, $update_data)
    {
        $uri = self::API_DOMAIN . '/?ct=user&ac=update';
        $body = empty($update_data) ? [] : $update_data;
        $body['_from_uid'] = $uid;
        return $this->post($uri, $body);
    }

    public function update_password($uid, $old_password, $new_password)
    {
        $uri = self::API_DOMAIN . '/?ct=user&ac=update_password';
        $query  = [
            '_from_uid' => $uid,
            'old_password' => $old_password,
            'new_password' => $new_password,
        ];
        return $this->post($uri, $query);
    }

    public function update_avatar($uid, $avatar)
    {
        $uri = self::API_DOMAIN . '/?ct=user&ac=update_avatar';
        $query  = [
            '_from_uid' => $uid,
            'avatar' => $avatar,
        ];
        return $this->post($uri, $query);
    }
}
