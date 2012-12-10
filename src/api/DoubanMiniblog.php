<?php
/**
 * @file DoubanMiniblog.php
 * @brief 豆瓣广播API
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-03
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

    public function statuses($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'DELETE':
                $this->uri = '/shuo/v2/statuses/'.$params['id'];
                break;
            case 'POST':
                $this->uri = '/shuo/v2/statuses';
                break;
        }
        return $this;
    }

    /**
     * @brief 获取一条广播的回复列表（未测试）
     *
     * @param string $id
     * @param int $start
     * @param int $count
     *
     * @return object
     */
    public function commentsList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/statuses/'.$params['id'].'/comments';
        unset($params['id']);
        $query = !empty($params) ? '?'.http_build_query($params) : null;
        $this->uri .= $query;
        return $this;
    }
    
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

    public function reshare($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/statuses/'.$params['id'].'/reshare';
        return $this;
    }

    /**
     * @brief 获取一条广播的赞相关信息（未测试）
     *
     * @param string $id
     *
     * @return object
     */
    public function likers($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/statuses/'.$params['id'].'/like';
        return $this;
    }

    public function like($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/statuses/'.$params['id'].'/like';
        return $this;
    }

    public function following($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/users/'.$params['id'].'/following';
        return $this;
    }

    public function followers($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/users/'.$params['id'].'/followers';
        return $this;
    }

    public function followInCommon($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/users/'.$params['id'].'/follow_in_common';
        return $this;
    }

    public function suggestions($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/users/'.$params['id'].'/following_followers_of';
        return $this;
    }

    public function block($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/users/'.$params['id'].'/block';
        return $this;

    }

    public function unfollow($requestType)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/friendships/destroy';
        return $this;

    }

    public function show($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/friendships/show?'.http_build_query($params);
        return $this;
    }

    /**
     * @brief 获取当前登录用户及其所关注用户的最新广播（友邻广播）
     *
     * @param string $sinceId
     * @param string $untilId
     * @param string $count
     * @param string $start
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
     * @brief 获取用户发布的广播列表
     *
     * @param string $user
     * @param string $sinceId
     * @param string $untilId
     *
     * @return object
     */
    public function userTimeline($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/shuo/v2/statuses/user_timeline/'.$params['user'];
        unset($params['user']);
        $query = !empty($params) ? '?'.http_build_query($params) : null;
        $this->uri .= $query;
        return $this;
    }
    
}
