<?php
/**
 * @file DoubanOnline.php
 * @brief 豆瓣线上活动API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-05
 */

class DoubanOnline extends DoubanBase {

    /**
     * @brief 构造函数，初始设置clientId
     *
     * @param string $clientId
     *
     * @return void
     */
    public function __construct($clientId)
    {
        $this->client = $clientId;
    }

    public function getOnline($id)
    {
        $this->uri = '/v2/online/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function participants($id)
    {
        $this->uri = '/v2/online/'.$id.'/participants';
        $this->type = 'GET';
        return $this;
    }

    public function getDiscussionsList($id)
    {
        $this->uri = '/v2/online/'.$id.'/discussions';
        $this->type = 'GET';
        return $this;
    }

    public function getOnlinesList($cate)
    {
        $this->uri = '/v2/onlines?cate='.$cate;
        $this->type = 'GET';
        return $this;
    }

    public function addOnline()
    {
        $this->uri = '/v2/onlines';
        $this->type = 'POST';
        return $this; 
    }

    public function editOnline($id)
    {
        $this->uri = '/v2/onlines/'.$id;
        $this->type = 'PUT';
        return $this; 
    }

    public function deleteOnline($id)
    {
        $this->uri = '/v2/onlines/'.$id;
        $this->type = 'DELETE';
        return $this; 
    }

    public function join($id)
    {
        $this->uri = '/v2/online/'.$id.'/participants';
        $this->type = 'POST';
        return $this; 
    }

    public function quit($id)
    {
        $this->uri = '/v2/online/'.$id.'/participants';
        $this->type = 'DELETE';
        return $this; 
    }

    public function like($id)
    {
        $this->uri = '/v2/online/'.$id.'/like';
        $this->type = 'POST';
        return $this; 
    }

    public function dislike($id)
    {
        $this->uri = '/v2/online/'.$id.'/like';
        $this->type = 'DELETE';
        return $this; 
    }

    public function getPhoto($id)
    {
        $this->uri = '/v2/online/'.$id.'/photos';
        $this->type = 'GET';
        return $this;
    }

    public function addPhoto($id)
    {
        $this->uri = '/v2/online/'.$id.'/photos';
        $this->type = 'POST';
        return $this; 
    }

    public function replyDiscussion($id)
    {
        $this->uri = '/v2/online/'.$id.'/discussions';
        $this->type = 'POST';
        return $this; 
    }

    public function userParticipated($id, $excludeExpired = true)
    {
        $this->uri = '/v2/online/user_participated/'.$id.'?exclude_expired='.$excludeExpired;
        $this->type = 'GET';
        return $this;
    }

    public function userCreated($id)
    {
        $this->uri = '/v2/online/user_created/'.$id;
        $this->type = 'GET';
        return $this;
    }
}
