<?php
/**
 * @file Miniblog.php
 * @brief 豆瓣广播API
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-11-27
 */

class Miniblog extends Base {

    /**
     * @brief 发送一条豆瓣广播
     *
     * @param string $accessToken
     *
     * @return object
     */
    public function shuo($accessToken)
    {
        $this->uri = '/shuo/v2/statuses/';

        $this->header = array(
                'Content_type: multipart/form-data',
                "Authorization: Bearer $accessToken",
                );

        $this->type = 'POST';

        return $this;   
    }
    
    /**
     * @brief 获取当前登录用户及其所关注用户的最新广播（友邻广播）
     *
     * @param string $accessToken
     * @param string $sinceId
     * @param string $untilId
     * @param string $count
     * @param string $start
     *
     * @return object
     */
    public function homeTimeline($accessToken, $sinceId = null, $untilId = null, $count = null, $start = null )
    {
        $this->uri = "/shuo/v2/statuses/home_timeline?since_id=$sinceId&until_id=$untilId
            &count=$count&start=$start";

        $this->header = array(
                'Authorization: Bearer '.$accessToken
                );

        return $this;

    }
    
    /**
     * @brief 获取用户发布的广播列表
     *
     * @param string $user
     * @param string $sinceId
     * @param string $untilId
     *
     * @return object
     */
    public function userTimeline($user, $sinceId = null, $untilId = null)
    {
        $this->uri = "/shuo/v2/statuses/user_timeline/$user?since_id=$sinceId&until_id=$untilId";

        return $this;
    }
    
    /**
     * @brief 单独读取一条广播
     *
     * @param string $id
     *
     * @return object
     */
    public function get($id)
    {
        $this->uri = "/shuo/v2/statuses/$id";
        
        return $this;
    }
    
    /**
     * @brief 删除一条广播
     *
     * @param string $accessToken
     * @param string $id
     *
     * @return object
     */
    public function delete($accessToken, $id)
    {
        $this->uri = "/shuo/v2/statuses/$id";

        $this->header = array("Authorization: Bearer $accessToken");

        $this->type = 'DELETE';

        return $this;
    }
    
}
