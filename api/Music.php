<?php
/**
 * @file Music.php
 * @brief 豆瓣音乐API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-12-02
 */

class Music extends Base {

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
        $this->uri = "/v2/music/$id";
        return $this;
    }

    public function search($q, $tag, $start = 0, $count = 20)
    {
        $this->uri = "/v2/music/search?q=$q&tag=$tag&start=$start&count=$count";
        return $this;
    }

    public function musicTags($id)
    {
        $this->uri = "/v2/music/$id/tags";
        return $this;
    }

    public function addReview()
    {
        $this->uri = "/v2/music/reviews";
        $this->header = $this->authorizeHeader;
        $this->type = "POST";
        return $this;
    }

    public function editReview($id)
    {
        $this->uri = "/v2/music/review/$id";
        $this->header = $this->authorizeHeader;
        $this->type = "PUT";
        return $this;
    }

    public function deleteReview($id)
    {
        $this->uri = "/v2/music/review/$id";
        $this->header = $this->authorizeHeader;
        $this->type = "DELETE";
        return $this;
    }

    public function userTags($id)
    {
        $this->uri = "/v2/music/user_tags/$id";
        return $this;
    }
}
