<?php
/**
 * @file Photo.php
 * @brief 豆瓣相册API接口
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-12-02
 */

class Photo extends Base {

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

    public function getAlbum($id)
    {
        $this->uri = "/v2/album/$id";
        return $this;
    }

    public function addAlbum()
    {
        $this->uri = "/v2/albums";
        $this->header = $this->authorizeHeader;
        $this->type = 'POST';
        return $this;
    }

    public function editAlbum($id)
    {
        $this->uri = "/v2/album/$id";
        $this->header = $this->authorizeHeader;
        $this->type = 'PUT';
        return $this;
    }

    public function deleteAlbum($id)
    {
        $this->uri = "/v2/album/$id";
        $this->header = $this->authorizeHeader;
        $this->type = 'DELETE';
        return $this;
    }


    public function getPhotosList($id)
    {
        $this->uri = "/v2/album/$id/photos";
        return $this;
    }

    public function getPhoto($id)
    {
        $this->uri = "/v2/photo/$id";
        return $this;
    }

    public function likeAlbum($id)
    {
        $this->uri = "/v2/album/$id/like";
        $this->header = $this->authorizeHeader;
        $this->type = 'POST';
        return $this;
    }

    public function dislikeAlbum($id)
    {
        $this->uri = "/v2/album/$id/like";
        $this->header = $this->authorizeHeader;
        $this->type = 'DELETE';
        return $this;
    }

    public function getUserAlbumList($id)
    {
        $this->uri = "/v2/album/user_created/$id";
        return $this;
    }

    public function userLiked($id)
    {
        $this->uri = "/v2/album/user_liked/$id";
        return $this;
    }

    public function addPhoto($id)
    {
        $this->uri = "/v2/album/$id";
        $this->header = $this->authorizeHeader;
        $this->type = 'POST';
        return $this;
    }

    public function editPhoto($id)
    {
        $this->uri = "/v2/album/$id";
        $this->header = $this->authorizeHeader;
        $this->type = 'PUT';
        return $this;
    }

    public function deletePhoto($id)
    {
        $this->uri = "/v2/album/$id";
        $this->header = $this->authorizeHeader;
        $this->type = 'DELETE';
        return $this;
    }

    public function likePhoto($id)
    {
        $this->uri = "/v2/photo/$id/like";
        $this->header = $this->authorizeHeader;
        $this->type = 'POST';
        return $this;
    }

    public function dislikePhoto($id)
    {
        $this->uri = "/v2/photo/$id/like";
        $this->header = $this->authorizeHeader;
        $this->type = 'DELETE';
        return $this;
    }

}
