<?php
/**
 * @file Doumail.php
 * @brief 豆邮API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-12-02
 */

class Doumail extends Base {

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
        $this->uri = "/v2/doumail/$id";
        $this->type = 'GET';
        return $this;
    }

    public function inbox()
    {
        $this->uri = "/v2/doumail/inbox";
        $this->type = 'GET';
        return $this;
    }

    public function outbox()
    {
        $this->uri = "/v2/doumail/outbox";
        $this->type = 'GET';
        return $this;
    }

    public function unread()
    {
        $this->uri = "/v2/doumail/inbox/unread";
        $this->type = 'GET';
        return $this;
    }

    public function read($id)
    {
        $this->uri = "/v2/doumail/$id";
        $this->type = "PUT";
        return $this;
    }

    public function mutilRead()
    {
        $this->uri = "/v2/doumail/read";
        $this->type = "PUT";
        return $this;
    }

    public function delete($id)
    {
        $this->uri = "/v2/doumail/$id";
        $this->type = "DELETE";
        return $this;
    }

    public function mutilDelete()
    {
        $this->uri = "/v2/doumail/delete";
        $this->type = "POST";
        return $this;
    }

    public function add()
    {
        $this->uri = "/v2/doumails";
        $this->type = "POST";
        return $this;
    }
}
