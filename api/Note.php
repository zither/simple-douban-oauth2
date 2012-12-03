<?php
/**
 * @file Note.php
 * @brief 豆瓣日记API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-02
 */

class Note extends Base {

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

    public function addNote()
    {
        $this->uri = "/v2/notes";
        $this->type = 'POST';
        return $this;   
    }

    public function editNote($id)
    {
        $this->uri = "/v2/note/$id";
        $this->type = 'PUT';
        return $this;   
    }

    public function deleteNote($id)
    {
        $this->uri = "/v2/note/$id";
        $this->type = 'DELETE';
        return $this;   
    }

    public function like($id)
    {
        $this->uri = "/v2/note/$id/like";
        $this->type = 'POST';
        return $this;   
    }

    public function dislike($id)
    {
        $this->uri = "/v2/note/$id/like";
        $this->type = 'DELETE';
        return $this;   
    }

    public function image($id)
    {
        $this->uri = "/v2/note/$id";
        $this->type = 'POST';
        return $this;  
    }

    public function getCommentsList($id)
    {
        $this->uri = "/v2/note/$id/comments";
        $this->type = 'GET';
        return $this;
    }

    public function reply($id)
    {
        $this->uri = "/v2/note/$id/comments";
        $this->type = 'POST';
        return $this;  
    }

    public function getComment($id)
    {
        $this->uri = "/v2/note/:id/comment/$id";
        $this->type = 'GET';
        return $this;
    }

    public function deleteComment($id)
    {
        $this->uri = "/v2/note/:id/comment/$id";
        $this->type = 'DELETE';
        return $this;
    }
}
