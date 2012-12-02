<?php
/**
 * @file Event.php
 * @brief 豆瓣同城API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-12-02
 */

class Event extends Base {

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
        $this->uri = "/v2/event/$id";
        return $this;
    }

    public function participants($id)
    {
        $this->uri = "/v2/event/$id/participants";
        return $this;
    }

    public function wishers($id)
    {
        $this->uri = "/v2/event/$id/wishers";
        return $this;
    }

    public function userCreated($id)
    {
        $this->uri = "/v2/event/user_created/$id";
        return $this;
    }

    public function userParticipated($id)
    {
        $this->uri = "/v2/event/user_participated/$id";
        return $this;
    }

    public function userWished($id)
    {
        $this->uri = "/v2/event/user_wished/$id";
        return $this;
    }

    public function eventList()
    {
        $this->uri = "/v2/event/list";
        return $this;
    }

    public function loc($id)
    {
        $this->uri = "/v2/loc/$id";
        return $this;
    }

    public function locList()
    {
        $this->uri = "/v2/loc/list";
        return $this;
    }

    public function join($id)
    {
        $this->uri = "/v2/event/$id/participants";
        $this->header = $this->authorizeHeader;
        $this->type = "POST";
        return $this;

    }

    public function quit($id)
    {
        $this->uri = "/v2/event/$id/participants";
        $this->header = $this->authorizeHeader;
        $this->type = "DELETE";
        return $this;
    }

    public function wish($id)
    {
        $this->uri = "/v2/event/$id/wishers";
        $this->header = $this->authorizeHeader;
        $this->type = "POST";
        return $this;
    }

    public function unwish($id)
    {
        $this->uri = "/v2/event/$id/wishers";
        $this->header = $this->authorizeHeader;
        $this->type = "DELETE";
        return $this;
    }
}
