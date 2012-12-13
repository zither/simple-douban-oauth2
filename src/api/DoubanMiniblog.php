<?php
/**
 * @file DoubanMiniblog.php
 * @brief 豆瓣广播API
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-13
 */

class DoubanMiniblog extends DoubanBase {

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
     * @brief 用户对豆瓣广播相关操作
     *
     * @param string $requestType GET,POST,DELETE
     * @param array $params
     *
     * @return object
     */
    public function statuses($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'DELETE':
                $this->uri = '/shuo/v2/statuses/'.$params['id'];
                break;
            case 'POST':
                $this->uri = '/shuo/v2/statuses/';
                break;
        }
        return $this;
    }
    
    /**
     * @brief 获取广播的回复列表
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function commentsList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/statuses/'.$params['id'].'/comments';
        unset($params['id']);
        if (!empty($params))
            $this->uri .= '?'.http_build_query($params);
        return $this;
    }
        
    /**
     * @brief 对广播回复的操作
     *
     * @param string $requestType GET,POST,DELETE
     * @param array $params
     *
     * @return object
     */
    public function comment($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'DELETE':
                $this->uri = '/shuo/v2/statuses/comment/'.$params['id'];
                break;
            case 'POST':
                $this->uri = '/shuo/v2/statuses/'.$params['id'].'/comments';
                break;
        }
        return $this;
    }
    
    /**
     * @brief 对转播相关操作
     *
     * @param string $requestType GET,POST
     * @param array $params
     *
     * @return object
     */
    public function reshare($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/statuses/'.$params['id'].'/reshare';
        return $this;
    }
    
    /**
     * @brief 赞某条广播
     *
     * @param string $requestType GET,POST
     * @param array $params
     *
     * @return object
     */
    public function like($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/statuses/'.$params['id'].'/like';
        return $this;
    }
    
    /**
     * @brief 获取用户关注列表。
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function following($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/users/'.$params['id'].'/following';
        return $this;
    }
    
    /**
     * @brief 获取用户关注者列表。
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function followers($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/users/'.$params['id'].'/followers';
        return $this;
    }


    /**
     * @brief 获取共同关注列表。 
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function followInCommon($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/users/'.$params['id'].'/follow_in_common';
        return $this;
    }
    
    /**
     * @brief 获取关注的人关注了该用户的列表。
     *
     * @param $requestType
     * @param $params
     *
     * @return 
     */
    public function suggestions($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/users/'.$params['id'].'/following_followers_of';
        return $this;
    }
    
    /**
     * @brief 将指定用户加入黑名单
     *
     * @param $requestType
     * @param $params
     *
     * @return 
     */
    public function block($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/users/'.$params['id'].'/block';
        return $this;

    }
    
    /**
     * @brief 关注一个用户
     *
     * @param string $requestType POST
     *
     * @return object
     */
    public function follow($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/friendships/create';
        return $this;
    }
    
    /**
     * @brief 取消关注
     *
     * @param string $requestType POST
     *
     * @return object
     */
    public function unfollow($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/friendships/destroy';
        return $this;

    }

    /**
     * @brief 获取两个用户的关系
     *
     * @param string $requestType GET
     * @param array $params source,source_id,target_id
     *
     * @return object
     */
    public function show($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/friendships/show?'.http_build_query($params);
        return $this;
    }

    
    /**
     * @brief 获取当前登录用户及其所关注用户的最新广播(友邻广播)
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function homeTimeline($requestType, $params)
    {
        $this->type = $requestType;
        $query = !empty($params) ? '?'.http_build_query($params) : null;
        $this->uri = '/shuo/v2/statuses/home_timeline'.$query;
        return $this;
    }
    
    /**
     * @brief 获取用户发表的广播列表
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function userTimeline($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/statuses/user_timeline/'.$params['user'];
        unset($params['user']);
        if (!empty($params))
            $this->uri .= '?'.http_build_query($params);
        return $this;
    }
    
}
