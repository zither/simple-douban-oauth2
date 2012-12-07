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
     * @brief 获取用户的基本个人信息
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
     * @brief 获取当前授权用户信息
     *
     * @return object
     */
    public function me()
    {
        $this->uri = '/v2/user/~me';
        $this->type = 'GET';
        return $this;
    }
    
    /**
     * @brief 获取指定ID用户信息
     *
     * @param string $id
     *
     * @return object
     */
    public function get($id)
    {
        $this->uri = '/v2/user/'.$id;
        $this->type = 'GET';
        return $this;
    }
    
    /**
     * @brief 搜索用户
     *
     * @param string $q
     * @param int $start
     * @param int $count
     *
     * @return object
     */
    public function search($q, $start = null, $count = null)
    {
        $params = array(
                    'q' => $q,
                    'start' => $start,
                    'count' => $count
                    );
        $this->uri = '/v2/user?'.http_build_query($params);
        $this->type = 'GET';
        return $this;
    }
    
}
