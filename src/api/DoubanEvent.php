<?php
/**
 * @file DoubanEvent.php
 * @brief 豆瓣同城API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-11
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
     
    /**
     * @brief 获取活动信息
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function info($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/'.$params['id'];
        return $this;
    }
    
    /**
     * @brief 获取对活动感兴趣的用户
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function wishers($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/'.$params['id'].'/wishers';
        return $this;
    }
    
    /**
     * @brief 获取用户创建的活动
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function userCreated($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/user_created/'.$params['id'];
        return $this;
    }
    
    /**
     * @brief 获取用户参与的活动
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function userParticipated($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/user_participated/'.$params['id'];
        return $this;
    }
    
    /**
     * @brief 获取用户感兴趣的活动
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function userWished($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/user_wished/'.$params['id'];
        return $this;
    }

    /**
     * @brief 获取同城活动列表
     *
     * @param string $requestType GET
     * @param array $params loc,day_type,type
     *
     * @return object
     */
    public function eventList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/list?'.http_build_query($params);
        return $this;
    }
    
    /**
     * @brief 获取城市信息
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function loc($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/loc/'.$params['id'];
        return $this;
    }
    
    /**
     * @brief 获取城市列表
     *
     * @param string $requestType GET
     *
     * @return object
     */
    public function locList($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/v2/loc/list';
        return $this;
    }

    /**
     * @brief 用户同城活动相关操作
     *
     * @param string $requestType 可为'POST','DELETE'
     * @param array $params
     *
     * @return object
     */
    public function participants($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/'.$params['id'].'/participants';
        return $this;
    }
    
    /**
     * @brief 用户对某活动的关注操作
     *
     * @param string $requestType POST,DELETE
     * @param array $params
     *
     * @return object
     */
    public function wish($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/event/'.$params['id'].'/wishers';
        return $this;
    }
}
