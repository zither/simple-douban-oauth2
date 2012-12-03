<?php
/**
 * @file Music.php
 * @brief 豆瓣音乐API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-02
 */

class Music extends Base {

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

    public function get($id)
    {
        $this->uri = "/v2/music/$id";
        $this->type = 'GET';
        return $this;
    }

    public function search($q, $tag, $start = 0, $count = 20)
    {
        $this->uri = "/v2/music/search?q=$q&tag=$tag&start=$start&count=$count";
        $this->type = 'GET';
        return $this;
    }

    public function musicTags($id)
    {
        $this->uri = "/v2/music/$id/tags";
        $this->type = 'GET';
        return $this;
    }

    public function addReview()
    {
        $this->uri = "/v2/music/reviews";
        $this->type = "POST";
        return $this;
    }

    public function editReview($id)
    {
        $this->uri = "/v2/music/review/$id";
        $this->type = "PUT";
        return $this;
    }

    public function deleteReview($id)
    {
        $this->uri = "/v2/music/review/$id";
        $this->type = "DELETE";
        return $this;
    }

    public function userTags($id)
    {
        $this->uri = "/v2/music/user_tags/$id";
        $this->type = 'GET';
        return $this;
    }
}
