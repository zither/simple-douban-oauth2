<?php
/**
 * @file DoubanMusic.php
 * @brief 豆瓣音乐API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-05
 */

class DoubanMusic extends DoubanBase {

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
     * @brief 获取音乐信息
     *
     * @param $id
     *
     * @return object
     */
    public function info($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/music/'.$params['id'];
        return $this;
    }
    
    /**
     * @brief 搜索音乐
     *
     * @param $q
     * @param $tag
     * @param $start
     * @param $count
     *
     * @return object
     */
    public function search($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/music/search?'.http_build_query($params);
        return $this;
    }
    
    /**
     * @brief 某个音乐中标记最多的标签
     *
     * @param $id
     *
     * @return object
     */
    public function musicTags($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/music/'.$params['id'].'/tags';
        return $this;
    }

    public function review($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'POST':
                $this->uri = '/v2/music/reviews';
                break;
            case 'PUT':
            case 'DELETE':
                $this->uri = '/v2/music/review/'.$params['id'];
                break;
        }
        return $this;
    }

    /**
     * @brief 用户对音乐的所有标签
     *
     * @param $id
     *
     * @return object
     */
    public function userTags($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/music/user_tags/'.$params['id'];
        return $this;
    }
}
