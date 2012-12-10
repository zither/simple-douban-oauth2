<?php
/**
 * @file DoubanEvent.php
 * @brief 豆瓣同城API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-05
 */

class DoubanEvent extends DoubanBase {

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
    
    public function info($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/'.$params['id'];
        return $this;
    }

    public function wishers($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/'.$params['id'].'/wishers';
        return $this;
    }

    public function userCreated($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/user_created/'.$params['id'];
        return $this;
    }

    public function userParticipated($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/user_participated/'.$params['id'];
        return $this;
    }

    public function userWished($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/user_wished/'.$params['id'];
        return $this;
    }

    public function eventList($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/list';
        return $this;
    }

    public function loc($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/loc/'.$params['id'];
        return $this;
    }

    public function locList($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/loc/list';
        return $this;
    }


    /**
     * @brief 同城活动相关操作
     *
     * @param string $requestType 可为'GET','POST','DELETE'
     * @param $params
     *
     * @return object
     */
    public function participants($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/'.$params['id'].'/participants';
        return $this;
    }

    public function wish($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/'.$params['id'].'/wishers';
        return $this;
    }
}
