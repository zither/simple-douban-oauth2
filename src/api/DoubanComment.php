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
    
    /**
     * @brief 获取评论列表
     *
     * @param string $requestType GET
     * @param array $params target,id
     *
     * @return object
     */
    public function commentsList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/'.$params['target'].'/'.$params['id'].'/comments';
        return $this;
    }
    
    /**
     * @brief 评论相关操作
     *
     * @param string $requestType GET,POST,DELETE
     * @param array $params target,targetId,commentId
     *
     * @return object
     */
    public function comment($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'DELETE':
                $this->uri = '/v2/'.$params['target'].'/'.$params['targetId'].'/comment/'.$params['commentId'];
                break;
            case 'POST':
                $this->uri = '/v2/'.$params['target'].'/'.$params['targetId'].'/comments';
                break;
        }
        return $this;
    }
}
