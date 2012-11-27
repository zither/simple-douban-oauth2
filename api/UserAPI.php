<?php
/**
 * @file UserAPI.php
 * @brief 豆瓣用户API
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.3
 * @date 2012-11-27
 */

class UserAPI extends Base {

    /**
     * @brief 豆瓣用户API，获取当前授权用户信息
     *
     * @param string $accessToken
     *
     * @return object
     */
    public function userMe($accessToken)
    {
        $this->uri = '/v2/user/~me';

        $this->header = array('Authorization: Bearer '.$accessToken);

        return $this;
    }
    
    /**
     * @brief 豆瓣用户API，获取指定ID用户信息
     *
     * @param string $id
     *
     * @return object
     */
    public function userGet($id)
    {
        $this->uri = '/v2/user/'.$id;

        return $this;
    }
    
    /**
     * @brief 豆瓣用户API，搜索用户
     *
     * @param string $q
     * @param int $start
     * @param int $count
     *
     * @return object
     */
    public function userSearch($q, $start, $count)
    {
        $this->uri = "/v2/user?q=$q&start=$start&count=$count";

        return $this;
    }
}
