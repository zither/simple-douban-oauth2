<?php
/**
 * @file DoubanOnline.php
 * @brief 豆瓣线上活动API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-05
 */

class DoubanOnline extends DoubanBase {

    /**
     * @brief 构造函数，初始设置clientId
     *
     * @param string $clientId
     *
     * @return void
     */
    public function __construct($clientId)
    {
        $this->client = $clientId;
    }

    public function discussionsList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/'.$params['id'].'/discussions';
        return $this;
    }

    public function onlinesList($requestType,$params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/onlines?cate='.$params['cate'];
        return $this;
    }

    public function online($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'PUT':
            case 'DELETE':
                $this->uri = '/v2/onlines/'.$params['id'];
                break;
            case 'POST':
                $this->uri = '/v2/onlines';
                break;
        }
        return $this;

    }

    public function participants($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
                $this->uri = '/v2/online/'.$params['id'].'/participants';
                break;
            case 'POST':
            case 'DELETE':
                $this->uri = '/v2/online/'.$params['id'].'/participants';
                break;
        }
        return $this;
    }

    public function like($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/'.$params['id'].'/like';
        return $this;
    }

    public function photo($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/'.$params['id'].'/photos';
        return $this;

    }

    public function replyDiscussion($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/'.$params['id'].'/discussions';
        return $this; 
    }

    public function userParticipated($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/user_participated/'.$params['id'];
        if (isset($params['excludeExpired'])) 
            $this->uri .= '?exclude_expired='.$excludeExpired;
        return $this;
    }

    public function userCreated($requestType, $params$)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/user_created/'.$params['id'];
        return $this;
    }
}
