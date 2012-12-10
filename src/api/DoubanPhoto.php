<?php
/**
 * @file DoubanPhoto.php
 * @brief 豆瓣相册API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-05
 */

class DoubanPhoto extends DoubanBase {

    /**
     * @brief 构造函数，初始设置clientId和accessToken
     *
     * @param string $clientId
     *
     * @return void
     */
    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }

    public function album($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
            case 'PUT':
            case 'DELETE':
                $this->uri = '/v2/album/'.$params['id'];
                break;
            case 'POST':
                $this->uri = '/v2/albums';
                break;
        }
        return $this;
    }

    public function photosList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/album/'.$params['id'].'/photos';
        return $this;
    }

    public function albumLike($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/album/'.$params['id'].'/like';
        return $this;
    }

    public function userAlbumList($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/album/user_created/'.$params['id'];
        return $this;
    }

    public function userLiked($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/album/user_liked/'.$params['id'];
        return $this;
    }

    public function photo($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'GET':
                $this->uri = '/v2/photo/'.$params['id'];
                break;
            case 'POST':
            case 'PUT':
            case 'DELETE':
                $this->uri = '/v2/album/'.$params['id'];
                break;
        }
        return $this;
    }

    public function photoLike($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/photo/'.$params['id'].'/like';
        return $this;
    }
}
