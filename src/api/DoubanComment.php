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

    public function getCommentsList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/'.$params['target'].'/'.$params['id'].'/comments';
        return $this;
    }

    public function addComment($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/'.$params['target'].'/'.$params['id'].'/comments';
        return $this; 
    }

    public function getComment($requestType, $params)
    {
        $this->type = $requestType; 
        $this->uri = '/v2/'.$params['target'].'/'.$params['targetId']
            .'/comment/'.$params['commentId'];
        return $this;
    }

    public function deleteComment($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/'.$params['target'].'/'.$params['targetId']
            .'/comment/'.$params['commentId'];
        return $this; 
    }
}
