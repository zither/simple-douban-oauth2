<?php
/**
 * @file Comment.php
 * @brief 豆瓣回复API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-03
 */

class Comment extends Base {

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

    public function getCommentsList($target, $id)
    {
        $this->uri = "/v2/$target/$id/comments";
        $this->type = 'GET';
        return $this;
    }

    public function addComment($target, $id)
    {
        $this->uri = "/v2/$target/$id/comments";
        $this->type = 'POST';
        return $this; 
    }

    public function getComment($target, $id)
    {
        $this->uri = "/v2/$target/$id/comment/:id";
        $this->type = 'GET';
        return $this;
    }

    public function deleteComment($target, $id)
    {
        $this->uri = "/v2/$target/$id/comments";
        $this->type = 'DELETE';
        return $this; 
    }
}
