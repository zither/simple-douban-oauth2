<?php
/**
 * @file Movie.php
 * @brief 豆瓣电影API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-12-02
 */

class Movie extends Base {

    /**
     * @brief 构造函数，初始设置clientId和accessToken
     *
     * @param string $clientId
     * @param string $accessToken
     *
     * @return void
     */
    public function __construct($clientId, $accessToken = null)
    {
        parent::__construct($clientId, $accessToken);
    }

    public function get($id)
    {
        $this->uri = "/v2/movie/:id";
        return $this;
    }

    public function imdb($name)
    {
        $this->uri = "/v2/movie/imdb/$name";
        return $this;
    }

    public function search($q, $tag, $start = 0, $count = 20)
    {
        $this->uri = "/v2/movie/search?q=$q&tag=$tag&start=$start&count=$count";
        return $this;
    }

    public function movieTags($id)
    {
        $this->uri = "/v2/movie/$id/tags";
        return $this;
    }

    public function userTags($id)
    {
        $this->uri = "/v2/movie/user_tags/$id";
        return $this;
    }

    public function addReview()
    {
        $this->uri = "/v2/movie/reviews";
        $this->header = $this->authorizeHeader;
        $this->type = "POST";
        return $this;

    }

    public function editReview($id)
    {
        $this->uri = "/v2/movie/review/$id";
        $this->header = $this->authorizeHeader;
        $this->type = "PUT";
        return $this;

    }

    public function deleteReview($id)
    {
        $this->uri = "/v2/movie/review/$id";
        $this->header = $this->authorizeHeader;
        $this->type = "DELETE";
        return $this;

    }
}
