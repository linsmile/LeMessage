<?php
namespace LeMessage\IM;
use LeMessage\IM;

class Friend extends IM {

    /**
     *   from_uid 直接 添加 friend_uid 为好友 (不需要申请/通过步骤，直接添加)
     *   接口文档: https://www.showdoc.cc/282759754120694?page_id=3412551957726513
     *
     * @param $from_uid
     * @param $friend_uid
     * @return mixed
     *
     */
    public function add($from_uid, $friend_uid)
    {
        $uri = self::API_DOMAIN . '/friend/add';

        $body = [
            '_from_uid' => $from_uid,
            'friend_uid'   => $friend_uid
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    /**
     *  from_uid 删除 friend_uid 好友关系
     *   接口文档: https://www.showdoc.cc/282759754120694?page_id=3412556172784542
     *
     * @param $from_uid
     * @param $friend_uid
     * @return mixed
     */
    public function delete($from_uid, $friend_uid)
    {
        $uri = self::API_DOMAIN . '/friend/delete';

        $body = [
            '_from_uid' => $from_uid,
            'friend_uid'   => $friend_uid
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    /**
     *   批量 为 from_uid 添加好友 $friends
     *   接口文档: https://www.showdoc.cc/282759754120694?page_id=2977064119778657
     *
     * @param String $from_uid
     * @param array  $friends   ['uid1', 'uid2', 'uid3']
     * @return mixed
     */
    public function batch_add($from_uid, array $friends)
    {
        $uri = self::API_DOMAIN . '/friend/batch_add';

        $body = [
            '_from_uid' => $from_uid,
            'friends'   => $friends
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    /**
     *  批量 为 from_uid 删除好友 $friends
     *  接口文档:  https://www.showdoc.cc/282759754120694?page_id=2977097630854121
     * @param $from_uid
     * @param array $friends  ['uid1', 'uid2', 'uid3']
     * @return mixed
     */
    public function batch_delete($from_uid, array $friends)
    {
        $uri = self::API_DOMAIN .  '/friend/batch_delete';

        $body = [
            '_from_uid' => $from_uid,
            'friends'   => $friends
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    /**
     *  好友列表
     *  接口文档: https://www.showdoc.cc/282759754120694?page_id=3011722781765109
     *
     * @param $from_uid
     * @param $status     1：正常状态的好友; 2:黑名单;  不传默认取 1
     * @return mixed
     */
    public function listAll($from_uid, $status)
    {
        $uri = self::API_DOMAIN . '/?ct=friend&ac=index';
        $body = [
            '_from_uid' => $from_uid,
            'status'   =>  $status
        ];
        $response = $this->post($uri, $body);
        return $response;
    }

    /**
     *   from_uid 申请添加 $friend_uid 为好友 (需要对方审核通过)
     *  接口文档: https://www.showdoc.cc/282759754120694?page_id=3107566518198162
     *
     * @param $from_uid
     * @param $friend_uid
     * @return mixed
     */
    public function request($from_uid, $friend_uid)
    {
        $uri = self::API_DOMAIN . '/?ct=friend&ac=request';
        $data = [
            '_from_uid'        => $from_uid,
            'friend_uid' => $friend_uid
        ];

        $response = $this->post($uri, $data);
        return $response;
    }

    /**
     *  from_uid 通过或拒绝 friend_uid 的好友申请
     *  接口文档: https://www.showdoc.cc/282759754120694?page_id=3107627475902621
     *
     * @param $from_uid
     * @param $friend_uid
     * @param $status      1 通过请求; -1 拒绝
     * @return mixed
     */
    public function approve($from_uid, $friend_uid, $status)
    {
        $uri = self::API_DOMAIN . '/?ct=friend&ac=approve';
        $data = [
            '_from_uid'        => $from_uid,
            'friend_uid' => $friend_uid,
            'status'          =>  $status
        ];

        $response = $this->post($uri, $data);
        return $response;
    }
}
