<?php
/**
 * @file DoubanNote.php
 * @brief 豆瓣日记API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-05
 */

class DoubanNote extends DoubanBase {

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
     * @brief 获取一条日记
     *
     * @param $id
     * @param $format
     *
     * @return object
     */
    public function note($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
                $this->uri = '/v2/note/'.$params['id'].'?format='.$params['format'];
            case 'POST':
                $this->uri = '/v2/notes';
                break;
            case 'PUT':
            case 'DELETE':
                $this->uri = '/v2/note/'.$params['id'];
                break;
        }
        return $this;
    }

    public function like($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/note/'.$params['id'].'/like';
        return $this;
    }

    public function image($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/note/'.$params['id'];
        return $this;  
    }

    public function commentsList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/note/'.$params['id'].'/comments';
        return $this;
    }

    public function comment($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'DELETE':
                $this->uri = '/v2/note/'.$params['noteId'].'/comment/'.$params['id'];
                break;
            case 'POST':
                $this->uri = '/v2/note/'.$params['id'].'/comments';
                break;
        }
        return $this;
    }
}
