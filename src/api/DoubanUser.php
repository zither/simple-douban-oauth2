<?php
/**
 * @file DoubanUser.php
 * @brief 豆瓣用户API
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-03
 */

class DoubanUser extends DoubanBase {

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
     * @brief 获取用户个人信息接口
     *
     * @param string $requestType HTTP请求方式
     * @param array $params api需要的参数
     *
     * @return object
     */
    public function info($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/user/'.$params['id'].'?apikey='.$this->clientId;
        return $this;
    }
    
    /**
     * @brief 获取当前登录用户信息接口
     *
     * @param string $requestType
     * @param array $params
     *
     * @return object
     */
    public function me($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/user/~me';
        return $this;
    }
    
    /**
     * @brief 搜索用户接口
     *
     * @param string $requestType
     * @param array $params
     *
     * @return object
     */
    public function search($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/user?'.http_build_query($params);
        return $this;
    }
}
