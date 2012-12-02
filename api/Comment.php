<?php
/**
 * @file Comment.php
 * @brief 豆瓣回复API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-12-02
 */

class Comment extends Base {

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

    public function getCommentsList($target, $id)
    {
        $this->uri = "/v2/$target/$id/comments";

        return $this;
    }

    public function addComment($target, $id)
    {
        $this->uri = "/v2/$target/$id/comments";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this; 
    }

    public function getComment($target, $id)
    {
        $this->uri = "/v2/$target/$id/comment/:id";

        return $this;
    }

    public function deleteComment($target, $id)
    {
        $this->uri = "/v2/$target/$id/comments";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'DELETE';

        return $this; 
    }
}
