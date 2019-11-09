<?php
namespace LeMessage\IM;
use LeMessage\IM;

class Friend extends IM {

    public function add($username, array $friends)
    {
        $uri = self::API_DOMAIN . '/friend/add';

        $body = [
            'username' => $username,
            'friends'   => $friends
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    public function delete($username, array $friends)
    {
        $uri = self::API_DOMAIN . '/?ct=friend&ac=delete';

        $body = [
            'username' => $username,
            'friends'   => $friends
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    public function listAll($username, $status)
    {
        $uri = self::API_DOMAIN . '/?ct=friend&ac=index';
        $body = [
            'username' => $username,
            'status'   =>  $status
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    public function request($username, $friend_username)
    {
        $uri = self::API_DOMAIN . '/?ct=friend&ac=request';
        $data = [
            'username'        => $username,
            'friend_username' => $friend_username
        ];

        $response = $this->post($uri, $data);
        return $response;
    }

    public function approve($username, $friend_username, $status)
    {
        $uri = self::API_DOMAIN . '/?ct=friend&ac=approve';
        $data = [
            'username'        => $username,
            'friend_username' => $friend_username,
            'status'          =>  $status
        ];

        $response = $this->post($uri, $data);
        return $response;
    }
}
