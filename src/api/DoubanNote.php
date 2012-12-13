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
     * @brief 豆瓣日记CRUD操作
     *
     * @param string $requestType GET,POST,PUT,DELETE
     * @param array $params id,format
     *
     * @return object
     */
    public function note($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
                $this->uri = '/v2/note/'.$params['id'];
                if (isset($params['format']))
                    $this->uri .= '?format='.$params['format'];
                break;
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
    
    /**
     * @brief 喜欢日记
     *
     * @param string $requestType POST,DELETE
     * @param array $params id
     *
     * @return object
     */
    public function like($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/note/'.$params['id'].'/like';
        return $this;
    }
    
    /**
     * @brief 上传图片到日记
     *
     * @param string $requestType POST
     * @param array $params id
     *
     * @return object
     */
    public function image($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/note/'.$params['id'];
        return $this;  
    }
    
    /**
     * @brief 日记的回复列表，和DoubanComment类中的api有重复，可能会合并。
     *
     * @param string $requestType GET
     * @param array $params id
     *
     * @return object
     */
    public function commentsList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/note/'.$params['id'].'/comments';
        return $this;
    }
    
    /**
     * @brief 日记评论相关操作
     *
     * @param string $requestType GET
     * @param array $params noteId,commentId
     *
     * @return object
     */
    public function comment($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'DELETE':
                $this->uri = '/v2/note/'.$params['noteId'].'/comment/'.$params['commentId'];
                break;
            case 'POST':
                $this->uri = '/v2/note/'.$params['noteId'].'/comments';
                break;
        }
        return $this;
    }
}
