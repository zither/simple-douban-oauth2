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
    public function get($id)
    {
        $this->uri = '/v2/music/'.$id;
        $this->type = 'GET';
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
    public function search($q, $tag = null, $start = 0, $count = 20)
    {
        $params = array(
                    'q' => $q,
                    'tag' => $tag,
                    'start' => $start,
                    'count' => $count
                    );
        $this->uri = '/v2/music/search?'.http_build_query($params);
        $this->type = 'GET';
        return $this;
    }
    
    /**
     * @brief 某个音乐中标记最多的标签
     *
     * @param $id
     *
     * @return object
     */
    public function musicTags($id)
    {
        $this->uri = '/v2/music/'.$id.'/tags';
        $this->type = 'GET';
        return $this;
    }

    public function addReview()
    {
        $this->uri = '/v2/music/reviews';
        $this->type = 'POST';
        return $this;
    }

    public function editReview($id)
    {
        $this->uri = '/v2/music/review/'.$id;
        $this->type = 'PUT';
        return $this;
    }

    public function deleteReview($id)
    {
        $this->uri = '/v2/music/review/'.$id;
        $this->type = 'DELETE';
        return $this;
    }
    
    /**
     * @brief 用户对音乐的所有标签
     *
     * @param $id
     *
     * @return object
     */
    public function userTags($id)
    {
        $this->uri = '/v2/music/user_tags/'.$id;
        $this->type = 'GET';
        return $this;
    }
}
