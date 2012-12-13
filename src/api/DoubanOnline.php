<?php
/**
 * @file DoubanOnline.php
 * @brief 豆瓣线上活动API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-13
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
    
    /**
     * @brief 获取线上活动论坛列表
     *
     * @param string $requestType GET,POST
     * @param array $params id
     *
     * @return object
     */
    public function discussions($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/'.$params['id'].'/discussions';
        return $this;
    }
    
    /**
     * @brief 获取线上活动列表
     *
     * @param string $requestType GET
     * @param array $params cate
     *
     * @return object
     */
    public function onlinesList($requestType,$params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/onlines?cate='.$params['cate'];
        return $this;
    }
    
    /**
     * @brief 线上活动相关操作
     *
     * @param string $requestType GET,POST,PUT,DELETE
     * @param array $params id
     *
     * @return object
     */
    public function online($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'PUT':
            case 'DELETE':
                $this->uri = '/v2/online/'.$params['id'];
                break;
            case 'POST':
                $this->uri = '/v2/onlines';
                break;
        }
        return $this;

    }
    
    /**
     * @brief 获取线上活动成员相关操作
     *
     * @param string $requestType GET,POST,DELETE
     * @param array $params id
     *
     * @return object
     */
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
    
    /**
     * @brief 喜欢或者不喜欢线上活动
     *
     * @param string $requestType POST,DELETE
     * @param array $params id
     *
     * @return object
     */
    public function like($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/'.$params['id'].'/like';
        return $this;
    }
    
    /**
     * @brief 线上活动图片列表
     *
     * @param string $requestType GET
     * @param array $params id
     *
     * @return object
     */
    public function photos($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/'.$params['id'].'/photos';
        return $this;

    }
    
    /**
     * @brief 获取用户参加的线上活动列表
     *
     * @param string $requestType GET
     * @param array $params id,excludeExpired
     *
     * @return object
     */
    public function userParticipated($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/user_participated/'.$params['id'];
        if (isset($params['excludeExpired'])) 
            $this->uri .= '?exclude_expired='.$excludeExpired;
        return $this;
    }
    
    /**
     * @brief 获取用户创建的线上活动列表
     *
     * @param string $requestType GET
     * @param array $params id
     *
     * @return object
     */
    public function userCreated($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/online/user_created/'.$params['id'];
        return $this;
    }
}
