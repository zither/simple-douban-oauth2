<?php
/**
 * @file Photo.php
 * @brief 豆瓣相册API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-02
 */
namespace Douban\api;

class Photo extends Base {

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

    public function getAlbum($id)
    {
        $this->uri = '/v2/album/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function addAlbum()
    {
        $this->uri = '/v2/albums';
        $this->type = 'POST';
        return $this;
    }

    public function editAlbum($id)
    {
        $this->uri = '/v2/album/'.$id;
        $this->type = 'PUT';
        return $this;
    }

    public function deleteAlbum($id)
    {
        $this->uri = '/v2/album/'.$id;
        $this->type = 'DELETE';
        return $this;
    }


    public function getPhotosList($id)
    {
        $this->uri = '/v2/album/'.$id.'/photos';
        $this->type = 'GET';
        return $this;
    }

    public function getPhoto($id)
    {
        $this->uri = '/v2/photo/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function likeAlbum($id)
    {
        $this->uri = '/v2/album/'.$id.'/like';
        $this->type = 'POST';
        return $this;
    }

    public function dislikeAlbum($id)
    {
        $this->uri = '/v2/album/'.$id.'/like';
        $this->type = 'DELETE';
        return $this;
    }

    public function getUserAlbumList($id)
    {
        $this->uri = '/v2/album/user_created/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function userLiked($id)
    {
        $this->uri = '/v2/album/user_liked/'.$id;
        $this->type = 'GET';
        return $this;
    }

    public function addPhoto($id)
    {
        $this->uri = '/v2/album/'.$id;
        $this->type = 'POST';
        return $this;
    }

    public function editPhoto($id)
    {
        $this->uri = '/v2/album/'.$id;
        $this->type = 'PUT';
        return $this;
    }

    public function deletePhoto($id)
    {
        $this->uri = '/v2/album/'.$id;
        $this->type = 'DELETE';
        return $this;
    }

    public function likePhoto($id)
    {
        $this->uri = '/v2/photo/'.$id.'/like';
        $this->type = 'POST';
        return $this;
    }

    public function dislikePhoto($id)
    {
        $this->uri = '/v2/photo/'.$id.'/like';
        $this->type = 'DELETE';
        return $this;
    }

}
