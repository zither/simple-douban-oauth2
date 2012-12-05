<?php
/**
 * @file DoubanMovie.php
 * @brief 豆瓣电影API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-05
 */

class DoubanMovie extends DoubanBase {

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
     * @brief 获取电影信息
     *
     * @param string $id
     *
     * @return object
     */
    public function get($id)
    {
        $this->uri = '/v2/movie/'.$id;
        $this->type = 'GET';
        return $this;
    }
    
    /**
     * @brief 根据imdb号获取电影信息
     *
     * @param string $name
     *
     * @return object
     */
    public function imdb($name)
    {
        $this->uri = '/v2/movie/imdb/'.$name;
        $this->type = 'GET';
        return $this;
    }

    public function search($q, $tag, $start = 0, $count = 20)
    {
        $params = array(
                    'q' => $q,
                    'tag' => $tag,
                    'start' => $start,
                    'count' => $count
                    );
        $this->uri = '/v2/movie/search?'.http_build_query($params);
        $this->type = 'GET';
        return $this;
    }

    public function movieTags($id)
    {
        $this->uri = '/v2/movie/'.$id.'/tags';
        $this->type = 'GET';
        return $this;
    }

    public function userTags($id)
    {
        $this->uri = '/v2/movie/user_tags/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function addReview()
    {
        $this->uri = '/v2/movie/reviews';
        $this->type = 'POST';
        return $this;

    }

    public function editReview($id)
    {
        $this->uri = '/v2/movie/review/'.$id;
        $this->type = 'PUT';
        return $this;

    }

    public function deleteReview($id)
    {
        $this->uri = '/v2/movie/review/'.$id;
        $this->type = 'DELETE';
        return $this;

    }
}
