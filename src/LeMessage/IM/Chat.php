<?php
namespace LeMessage\IM;
use LeMessage\IM;

class Chat extends IM
{

    public function create(array $user_list, $title, $unique_key = '')
    {
        $uri = self::API_DOMAIN . '/?ct=chat&ac=create';

        $query  = [
            'user_list'  => $user_list,
            'title'      => $title,
            'unique_key' => $unique_key,
        ];

        return $this->post($uri, $query);
    }

    public function detail($username, $chat_id)
    {
        $uri = self::API_DOMAIN . '/?ct=chat&ac=detail';

        $query = [
            'username' => $username,
            'chat_id' => $chat_id
        ];

        return $this->post($uri, $query);
    }

    public function listAll($username)
    {
        $uri = self::API_DOMAIN . '/?ct=chat&ac=index';

        $query = [
            'username' => $username,
        ];

        return $this->post($uri, $query);
    }

    public function kick($chat_id, $username)
    {
        $uri = self::API_DOMAIN . '/?ct=chat&ac=kick';

        $query = [
            'username' => $username,
            'chat_id' => $chat_id
        ];

        return $this->post($uri, $query);
    }

    public function join($chat_id,  $username)
    {
        $uri = self::API_DOMAIN . '/?ct=chat&ac=join';

        $query = [
            'username' => $username,
            'chat_id' => $chat_id
        ];

        return $this->post($uri, $query);
    }
}
