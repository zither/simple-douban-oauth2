<?php
/**
 * @file Discussion.php
 * @brief 豆瓣论坛API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-12-02
 */

class Discussion extends Base {

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

    public function getDiscussion($id)
    {
        $this->uri = "/v2/discussion/$id";

        return $this;
    }

    public function editDiscussion($id)
    {
        $this->uri = "/v2/discussion/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'PUT';

        return $this;   
    }

    public function deleteDiscussion($id)
    {
        $this->uri = "/v2/discussion/$id";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'DELETE';

        return $this;   
    }

    public function addDiscussion($target, $id)
    {
        $this->uri = "/v2/$target/$id/discussions";

        $this->header = array(
                'Authorization: Bearer '.$this->accessToken,
                );

        $this->type = 'POST';

        return $this; 
    }

    public function getDiscussionsList($target, $id)
    {   
        $this->uri = "/v2/$target/$id/discussions";

        return $this;
    }
}
