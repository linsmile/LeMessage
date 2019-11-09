<?php
namespace LeMessage\IM;
use LeMessage\IM;

class User extends IM {

    public function register($data)
    {
        $uri = self::API_DOMAIN . '/?ct=user&ac=reg';

        return $this->post($uri, $data);
    }

    public function show($username)
    {
        $uri = self::API_DOMAIN . '/?ct=user&ac=show';
        $query = ['username' => $username];
        return $this->post($uri, $query);
    }

    public function update($username, $update_data)
    {
        $uri = self::API_DOMAIN . '/?ct=user&ac=update';
        $body = empty($update_data) ? [] : $update_data;
        $body['username'] = $username;
        return $this->post($uri, $body);
    }

    public function update_password($username, $old_password, $new_password)
    {
        $uri = self::API_DOMAIN . '/?ct=user&ac=update_password';
        $query  = [
            'username' => $username,
            'old_password' => $old_password,
            'new_password' => $new_password,
        ];
        return $this->post($uri, $query);
    }

    public function update_avatar($username, $avatar)
    {
        $uri = self::API_DOMAIN . '/?ct=user&ac=update_avatar';
        $query  = [
            'username' => $username,
            'avatar' => $avatar,
        ];
        return $this->post($uri, $query);
    }
}
