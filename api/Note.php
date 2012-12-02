<?php
/**
 * @file Note.php
 * @brief 豆瓣日记API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-12-02
 */

class Note extends Base {

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

    public function addNote()
    {
        $this->uri = "/v2/notes";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this;   
    }

    public function editNote($id)
    {
        $this->uri = "/v2/note/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'PUT';

        return $this;   
    }

    public function deleteNote($id)
    {
        $this->uri = "/v2/note/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'DELETE';

        return $this;   
    }

    public function like($id)
    {
        $this->uri = "/v2/note/$id/like";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this;   
    }

    public function dislike($id)
    {
        $this->uri = "/v2/note/$id/like";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'DELETE';

        return $this;   
    }

    public function image($id)
    {
        $this->uri = "/v2/note/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this;  
    }

    public function getCommentsList($id)
    {
        $this->uri = "/v2/note/$id/comments";

        return $this;
    }

    public function reply($id)
    {
        $this->uri = "/v2/note/$id/comments";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this;  
    }

    public function getComment($id)
    {
        $this->uri = "/v2/note/:id/comment/$id";

        return $this;
    }

    public function deleteComment($id)
    {
        $this->uri = "/v2/note/:id/comment/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'DELETE';

        return $this;
    }
}
