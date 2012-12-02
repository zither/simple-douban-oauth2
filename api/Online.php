<?php
/**
 * @file Online.php
 * @brief 豆瓣线上活动API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-12-02
 */

class Online extends Base {

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

    public function getOnline($id)
    {
        $this->uri = "/v2/online/$id";

        return $this;
    }

    public function participants($id)
    {
        $this->uri = "/v2/online/$id/participants";

        return $this;
    }

    public function getDiscussionsList($id)
    {
        $this->uri = "/v2/online/$id/discussions";

        return $this;
    }

    public function getOnlinesList($cate)
    {
        $this->uri = "/v2/onlines?cate=$cate";

        return $this;
    }

    public function addOnline()
    {
        $this->uri = "/v2/onlines";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this; 
    }

    public function editOnline($id)
    {
        $this->uri = "/v2/onlines/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'PUT';

        return $this; 
    }

    public function deleteOnline($id)
    {
        $this->uri = "/v2/onlines/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'DELETE';

        return $this; 
    }

    public function join($id)
    {
        $this->uri = "/v2/online/$id/participants";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this; 
    }

    public function quit($id)
    {
        $this->uri = "/v2/online/$id/participants";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'DELETE';

        return $this; 
    }

    public function like($id)
    {
        $this->uri = "/v2/online/$id/like";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this; 
    }

    public function dislike($id)
    {
        $this->uri = "/v2/online/$id/like";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'DELETE';

        return $this; 
    }

    public function getPhoto($id)
    {
        $this->uri = "/v2/online/$id/photos";

        return $this;
    }

    public function addPhoto($id)
    {
        $this->uri = "/v2/online/$id/photos";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this; 
    }

    public function replyDiscussion($id)
    {
        $this->uri = "/v2/online/$id/discussions";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this; 
    }

    public function userParticipated($id, $excludeExpired = true)
    {
        $this->uri = "/v2/online/user_participated/$id?exclude_expired=$excludeExpired";

        return $this;
    }

    public function userCreated($id)
    {
        $this->uri = "/v2/online/user_created/$id";

        return $this;
    }
}
