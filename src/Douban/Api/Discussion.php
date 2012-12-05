<?php
/**
 * @file Discussion.php
 * @brief 豆瓣论坛API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-02
 */
namespace Douban\Api;

class Discussion extends Base {

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


    public function getDiscussion($id)
    {
        $this->uri = '/v2/discussion/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function editDiscussion($id)
    {
        $this->uri = '/v2/discussion/'.$id;
        $this->type = 'PUT';
        return $this;   
    }

    public function deleteDiscussion($id)
    {
        $this->uri = '/v2/discussion/'.$id;
        $this->type = 'DELETE';
        return $this;   
    }

    public function addDiscussion($target, $id)
    {
        $this->uri = '/v2/'.$target.'/'.$id.'/discussions';
        $this->type = 'POST';
        return $this; 
    }

    public function getDiscussionsList($target, $id)
    {   
        $this->uri = '/v2/'.$target.'/'.$id.'/discussions';
        $this->type = 'GET';
        return $this;
    }
}
