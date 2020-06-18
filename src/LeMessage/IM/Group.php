<?php
namespace LeMessage\IM;
use LeMessage\IM;

class Group extends IM {

    /**
     *  $from_uid, 创建一个群聊，名字为title, 群头像为 avatar (可以为空,值是上传到aws的文件名,如: files/xxxxxx.jpg）
     *  接口文档: https://www.showdoc.cc/282759754120694?page_id=3066231668520286
     *
     * @param $from_uid
     * @param array $user_list  ['uid1', 'uid2', 'uid3']
     * @param $title            群名字
     * @param $avatar           群头像
     * @return mixed
     */
    public function create($from_uid, array $user_list, $title,  $avatar = '') {
        $uri = self::API_DOMAIN .  '/?ct=group&ac=create';
        $body = [
            '_from_uid'  => $from_uid,
            'user_list' => $user_list,
            'title'     => $title,
            'avatar'    => $avatar
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    /**
     *  $from_uid 邀请 $user_list 加入群聊
     *   接口文档: https://www.showdoc.cc/282759754120694?page_id=3066277763856483
     *
     * @param $from_uid
     * @param $chat_id          会话ID
     * @param array $user_list  ['uid1', 'uid2', 'uid3']
     * @return mixed
     */
    public function invite($from_uid, $chat_id, array $user_list) {
        $uri = self::API_DOMAIN .  '/?ct=group&ac=invite';
        $body = [
            '_from_uid'  => $from_uid,
            'user_list' => $user_list,
            'chat_id'   => $chat_id,
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    /**
     *  $from_uid 把  user_list 踢出群聊
     *   接口文档 : https://www.showdoc.cc/282759754120694?page_id=3066280290701638
     *
     * @param $from_uid
     * @param $chat_id           会话ID
     * @param array $user_list   ['uid1', 'uid2', 'uid3']
     * @return mixed
     */
    public function kick($from_uid, $chat_id, array $user_list) {
        $uri = self::API_DOMAIN .  '/?ct=group&ac=kick';
        $body = [
            '_from_uid'  => $from_uid,
            'user_list' => $user_list,
            'chat_id'   => $chat_id,
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    /**
     *  $from_uid 退出了群聊， 如果 from_uid 是创建人， 如果指定了 new_master_uid,则群转让给 new_master_uid, 如果不指定，解散群.
     *  接口文档:  https://www.showdoc.cc/282759754120694?page_id=3066302996964346
     * @param $from_uid
     * @param $chat_id
     * @param string $new_master_uid
     * @return mixed
     */
    public function quit($from_uid, $chat_id, $new_master_uid = '')  {
        $uri = self::API_DOMAIN .  '/?ct=group&ac=quit';
        $body = [
            '_from_uid'  => $from_uid,
            'chat_id'   => $chat_id,
            'new_master_uid' => $new_master_uid
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    /**
     *  $from_uid 修改群信息
     *  接口文档: https://www.showdoc.cc/282759754120694?page_id=3066303973586713
     *
     * @param $from_uid
     * @param $chat_id
     * @param $title
     * @param $avatar
     * @return mixed
     */
    public function update($from_uid,  $chat_id, $title = '', $avatar = '')
    {
        $uri = self::API_DOMAIN .  '/?ct=group&ac=update';
        $body = [
            '_from_uid'  => $from_uid,
            'chat_id'   => $chat_id,
            'title'     => $title,
            'avatar'    => $avatar
        ];
        $response = $this->post($uri, $body);
        return $response;
    }
}
