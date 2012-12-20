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


    /**
     * @brief 对单封豆邮的相关操作
     *
     * @param string $requestType GET,POST,PUT,DELETE
     * @param array $params
     *
     * @return object
     */
    public function mail($requestType, $params)
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
     * @param string $requestType GET
     *
     * @return object
     */
    public function inbox($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/doumail/inbox';
        return $this;
    }
    
    /**
     * @brief 获取用户发件箱
     *
     * @param string $requestType GET
     *
     * @return object
     */
    public function outbox($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/doumail/outbox';
        return $this;
    }
    
    /**
     * @brief 获取用户未读豆邮
     *
     * @param string $requestType GET
     *
     * @return object
     */
    public function unread($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/doumail/inbox/unread';
        return $this;
    }
    
    /**
     * @brief 批量标记豆邮为已读
     *
     * @param string $requestType PUT
     *
     * @return object
     */
    public function multiRead($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/doumail/read';
        return $this;
    }


    /**
     * @brief 批量删除豆邮
     *
     * @param string $requestType POST 这是一个奇葩，用的是POST请求
     *
     * @return object
     */
    public function multiDelete($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/doumail/delete';
        return $this;
    }
}
