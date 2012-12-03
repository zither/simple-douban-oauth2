<?php
/**
 * @file Event.php
 * @brief 豆瓣同城API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-03
 */

class Event extends Base {

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
        $this->uri = '/v2/event/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function participants($id)
    {
        $this->uri = '/v2/event/'.$id.'/participants';
        $this->type = 'GET';
        return $this;
    }

    public function wishers($id)
    {
        $this->uri = '/v2/event/'.$id.'/wishers';
        $this->type = 'GET';
        return $this;
    }

    public function userCreated($id)
    {
        $this->uri = '/v2/event/user_created/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function userParticipated($id)
    {
        $this->uri = '/v2/event/user_participated/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function userWished($id)
    {
        $this->uri = '/v2/event/user_wished/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function eventList()
    {
        $this->uri = '/v2/event/list';
        $this->type = 'GET';
        return $this;
    }

    public function loc($id)
    {
        $this->uri = '/v2/loc/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function locList()
    {
        $this->uri = '/v2/loc/list';
        $this->type = 'GET';
        return $this;
    }

    public function join($id)
    {
        $this->uri = '/v2/event/'.$id.'/participants';
        $this->type = 'POST';
        return $this;

    }

    public function quit($id)
    {
        $this->uri = '/v2/event/'.$id.'/participants';
        $this->type = 'DELETE';
        return $this;
    }

    public function wish($id)
    {
        $this->uri = '/v2/event/'.$id.'/wishers';
        $this->type = 'POST';
        return $this;
    }

    public function unwish($id)
    {
        $this->uri = '/v2/event/'.$id.'/wishers';
        $this->type = 'DELETE';
        return $this;
    }
}
