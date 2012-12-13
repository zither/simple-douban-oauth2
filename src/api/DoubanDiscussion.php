<?php
/**
 * @file DoubanDiscussion.php
 * @brief 豆瓣论坛API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-13
 */

class DoubanDiscussion extends DoubanBase {

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

    public function discussion($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'PUT':
            case 'DELETE':
                $this->uri = '/v2/discussion/'.$params['id'];
                break;
            case 'POST':
                $this->uri = '/v2/'.$params['target'].'/'.$params['id'].'/discussions';
                break;
        }
        return $this;
    }
    
    /**
     * @brief 获取相关内容评论列表
     *
     * @param string $requestType GET
     * @param array $params target,id
     *
     * @return object
     */
    public function discussionsList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/'.$params['target'].'/'.$params['id'].'/discussions';
        return $this;
    }
}
