<?php
namespace LeMessage\IM;
use LeMessage\IM;

class Chat extends IM
{
    /**
     *  创建会话
     * @param array $user_list
     * @param $title
     * @param string $unique_key
     * @return mixed
     */
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

    /**
     *  从 from_uid 的视觉获得 会话详情  chat_id 和 uid  二选一
     *
     * @param $from_uid
     * @param $chat_id
     * @param $uid
     * @return mixed
     */
    public function detail($from_uid, $chat_id, $uid)
    {
        $uri = self::API_DOMAIN . '/?ct=chat&ac=detail';

        $query = [
            '_from_uid' => $from_uid,
            'uid'     => $uid,
            'chat_id' => $chat_id
        ];

        return $this->post($uri, $query);
    }

    /**
     *  获得 全部会话
     * @param $uid
     * @return mixed
     */
    public function listAll($from_uid)
    {
        $uri = self::API_DOMAIN . '/?ct=chat&ac=index';

        $query = [
            '_from_uid' => $from_uid,
        ];

        return $this->post($uri, $query);
    }

    /**
     *  将 uid 移出 会话 chat_id
     * @param $chat_id
     * @param $uid
     * @return mixed
     */
    public function kick($chat_id, $uid)
    {
        $uri = self::API_DOMAIN . '/?ct=chat&ac=kick';

        $query = [
            'uid' => $uid,
            'chat_id' => $chat_id
        ];

        return $this->post($uri, $query);
    }

    /**
     *  将 uid 加入 会话 chat_id
     * @param $chat_id
     * @param $uid
     * @return mixed
     */
    public function join($chat_id, $uid)
    {
        $uri = self::API_DOMAIN . '/?ct=chat&ac=join';

        $query = [
            'uid' => $uid,
            'chat_id' => $chat_id
        ];

        return $this->post($uri, $query);
    }
}
