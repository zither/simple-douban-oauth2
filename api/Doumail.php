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
        $this->uri = "/v2/doumail/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken
                );

        return $this;
    }

    public function inbox()
    {
        $this->uri = "/v2/doumail/inbox";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken
                );

        return $this;
    }

    public function outbox()
    {
        $this->uri = "/v2/doumail/outbox";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken
                );

        return $this;
    }

    public function unread()
    {
        $this->uri = "/v2/doumail/inbox/unread";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken
                );

        return $this;
    }

    public function read($id)
    {
        $this->uri = "/v2/doumail/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken
                );
        $this->type = "PUT";

        return $this;
    }

    public function mutilRead()
    {
        $this->uri = "/v2/doumail/read";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken
                );

        $this->type = "PUT";

        return $this;
    }

    public function delete($id)
    {
        $this->uri = "/v2/doumail/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken
                );

        $this->type = "DELETE";

        return $this;
    }

    public function mutilDelete()
    {
        $this->uri = "/v2/doumail/delete";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken
                );

        $this->type = "POST";

        return $this;
    }

    public function add()
    {
        $this->uri = "/v2/doumails";

        $this->header = array(
                    'Authorization: Bearer '.$this->accessToken
                    );

        $this->type = "POST";

        return $this;
    }
}
