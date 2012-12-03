<?php
/**
 * @file User.php
 * @brief 豆瓣用户API
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-03
 */

class User extends Base {

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
        $this->uri = "/v2/user?q=$q&start=$start&count=$count";
        $this->type = 'GET';
        return $this;
    }
    
}
