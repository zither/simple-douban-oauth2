<?php
/**
 * @file DuobanComment.php
 * @brief 豆瓣回复API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-05
 */

class DoubanComment extends DoubanBase {

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
        $this->uri = '/v2/'.$target.'/'.$id.'/comments';
        $this->type = 'GET';
        return $this;
    }

    public function addComment($target, $id)
    {
        $this->uri = '/v2/'.$target.'/'.$id.'/comments';
        $this->type = 'POST';
        return $this; 
    }

    public function getComment($target, $targetId, $commentId)
    {
        $this->uri = '/v2/'.$target.'/'.$targetId.'/comment/'.$commentId;
        $this->type = 'GET';
        return $this;
    }

    public function deleteComment($target, $targetId, $commentId)
    {
        $this->uri = '/v2/'.$target.'/'.$targetId.'/comment/'.$commentId;
        $this->type = 'DELETE';
        return $this; 
    }
}
