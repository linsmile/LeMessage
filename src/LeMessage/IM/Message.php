<?php
namespace LeMessage\IM;
use LeMessage\IM;

class Message extends IM {

    const MSG_TEXT = 1;

    const MSG_IMAGE = 2;

    const MSG_VOICE = 3;

    const MSG_FILE = 4;

    const MSG_LOCATION = 5;

    const MSG_VIDEO = 6;

    /**
     * 发送文字消息
     * @param $username     发送者用户标识
     * @param $chat_id      会话ID
     * @param $text         发送文字
     * @param string $msg_id  消息ID 如果不为空，会修改该消息
     * @return mixed
     */
    public function sendText($username, $chat_id, $text, $msg_id = '')
    {

        $opts = [
            'msg_type' => self::MSG_TEXT,
            'username' => $username,
            'chat_id' => $chat_id,
            'content' => [
                'text' => $text,
            ],
            'msg_id' => $msg_id,
        ];

        return $this->send($opts);
    }

    /**
     *  发送图片消息
     * @param $username       发送者用户标识
     * @param $queue_id       会话ID
     * @param array $image    图片对象
     * @param string $text    发送文字
     * @param string $msg_id  消息ID 如果不为空，表示修改消息
     * @return mixed
     */
    public function sendImage($username, $chat_id, array $image, $text = '', $msg_id = '')
    {
        $opts = [
            'msg_type' => self::MSG_IMAGE,
            'username' => $username,
            'chat_id' => $chat_id,
            'content' => [
                'image' => [
                    'src' => [
                        'name' => $image['name'],
                        'type' => $image['type'],
                        'hash' => $image['hash'],
                        'width' => $image['width'],
                        'height' => $image['height'],
                        'size' => $image['size'],
                        'realname' => $image['realname'],
                    ],
                ],
                'text' => $text,
            ],
            'msg_id' => $msg_id,
        ];

        return $this->send($opts);
    }

    public function send(array $options)
    {
        $uri = self::API_DOMAIN . '/?ct=message&ac=post';
        $body = $options;
        $response = $this->post($uri, $body);
        return $response;
    }

    public function delete($username, $queue_id, array $msg_ids, $for_all)
    {
        $query  = [
            'msg_ids'  => implode(',', $msg_ids),
            'for_all'  => $for_all,
            'queue_id' => $queue_id,
            'username' => $username,
        ];

        $uri =  self::API_DOMAIN . '/message/delete';
        return $this->post($uri,  $query);
    }

    public function pull($username, $chat_id, $seq_id = 0, $offset =  0, $pagesize = 15)
    {
        $query = [
            'username' => $username,
            'chat_id'  => $chat_id,
            'seq_id'   => $seq_id,
            'offset'   => $offset,
            'pagesize' => $pagesize
        ];
        $uri = self::API_DOMAIN . '/message/pull';
        return $this->post($uri, $query);
    }

    public function latest($username, $chat_id, $seq_id = 0, $offset =  0, $pagesize = 15)
    {
        $query = [
            'username' => $username,
            'chat_id'  => $chat_id,
            'seq_id'   => $seq_id,
            'offset'   => $offset,
            'pagesize' => $pagesize
        ];
        $uri = self::API_DOMAIN . '/message/latest';
        return $this->post($uri, $query);
    }
}
