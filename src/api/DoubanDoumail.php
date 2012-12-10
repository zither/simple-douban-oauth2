<?php
/**
 * @file DoubanDoumail.php
 * @brief 豆邮API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-05
 */

class DoubanDoumail extends DoubanBase {

    /**
     * @brief 构造函数，初始设置clientId
     *
     * @param string $clientId
     *
     * @return void
     */
    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }
    
    public function doumail($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'PUT':
            case 'DELETE':
                $this->uri = '/v2/doumail/'.$params['id'];
                break;
            case 'POST':
                $this->uri = '/v2/doumails';
                break;
        }
        return $this;

    }
    /**
     * @brief 获取用户收件箱
     *
     * @return object
     */
    public function inbox($reuestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/doumail/inbox';
        return $this;
    }

    public function outbox($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/doumail/outbox';
        return $this;
    }

    public function unread($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/doumail/inbox/unread';
        return $this;
    }

    public function mutilRead($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/doumail/read';
        return $this;
    }

    public function mutilDelete($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/doumail/delete';
        return $this;
    }
}
