<?php
namespace LeMessage\IM;
use LeMessage\IM;

class Group extends IM {

    public function create($username, array $user_list, $title,  $avatar) {
        $uri = self::API_DOMAIN .  '/?ct=group&ac=create';
        $body = [
            'username'  => $username,
            'user_list' => $user_list,
            'title'     => $title,
            'avatar'    => $avatar
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    public function invite($username, $chat_id, array $user_list) {
        $uri = self::API_DOMAIN .  '/?ct=group&ac=invite';
        $body = [
            'username'  => $username,
            'user_list' => $user_list,
            'chat_id'   => $chat_id,
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    public function kick($username, $chat_id, array $user_list) {
        $uri = self::API_DOMAIN .  '/?ct=group&ac=kick';
        $body = [
            'username'  => $username,
            'user_list' => $user_list,
            'chat_id'   => $chat_id,
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    public function quit($username, $chat_id, $new_master_username = '')  {
        $uri = self::API_DOMAIN .  '/?ct=group&ac=quit';
        $body = [
            'username'  => $username,
            'chat_id'   => $chat_id,
            'new_master_username' => $new_master_username
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    public function update($username,  $chat_id, $title, $avatar)
    {
        $uri = self::API_DOMAIN .  '/?ct=group&ac=update';
        $body = [
            'username'  => $username,
            'chat_id'   => $chat_id,
            'title'     => $title,
            'avatar'    => $avatar
        ];
        $response = $this->post($uri, $body);
        return $response;
    }
}
