<?php
/**
 * @file Book.php
 * @brief 豆瓣图书API
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-11-27
 */

class Book extends Base {
    
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
     * @brief 获取指定书籍
     *
     * @param int $id
     *
     * @return object
     */
    public function getBook($id)
    {
        $this->uri = '/v2/book/'.$id;
        $this->type = 'GET';
        return $this;
    }
    
    /**
     * @brief 获取Isbn对应书籍
     *
     * @param string $name
     *
     * @return object
     */
    public function isbn($name)
    {
        $this->uri = "/v2/book/isbn/$name";
        $this->type = 'GET';
        return $this;
    }
   
    /**
     * @brief 图书搜素接口(未测试)，q和tag必选其一。
     *
     * @param string $q
     * @param string $tag
     * @param int $start
     * @param int $count
     *
     * @return object 
     */
    public function search($q, $tag, $start = 0, $count = 20)
    {
        $this->uri = "/v2/book/search?q=$q&tag=$tag&start=$start&count=$count";
        $this->type = 'GET';
        return $this;
    }
    /**
     * @brief 获取某个图书中标记最多的标签(未测试)
     *
     * @param string $id
     *
     * @return object
     */
    public function bookTags($id)
    {
        $this->uri = '/v2/book/'.$id.'/tags';
        $this->type = 'GET';
        return $this;    
    }
   
    /**
     * @brief 获取用户对图书的所有标签(未测试)
     *
     * @param string $name
     *
     * @return object
     */
    public function userTags($name)
    {
        $this->uri = "/v2/book/user/$name/tags";
        $this->type = 'GET';
        return $this;
    }
    
    /**
     * @brief 获取某个用户的所有图书收藏信息(未测试)
     *
     * @param string $name
     *
     * @return object
     */
    public function collections($name)
    {
        $this->uri = "/v2/book/user/$name/collections";
        $this->type = 'GET';
        return $this;
    }
    
    /**
     * @brief 获取用户对某本图书的收藏信息(为测试)
     *
     * @param string $id
     *
     * @return object
     */
    public function getCollection($id)
    {
        $this->uri = "/v2/book/$id/collection";
        $this->type = 'GET';
        return $this;
    }
     
    /**
     * @brief 用户收藏某本图书(未测试)
     *
     * @param string $id
     *
     * @return object
     */
    public function addCollection($id)
    {
        $this->uri = "/v2/book/$id/collection";
        $this->type = "POST";
        return $this;
    }

    /**
     * @brief 用户修改对某本图书的收藏(未测试)
     *
     * @param string $id
     *
     * @return object
     */
    public function editCollection($id)
    {
        $this->uri = "/v2/book/$id/collection";
        $this->type = "PUT";
        return $this;
    }

    /**
     * @brief 用户删除对某本图书的收藏(未测试)
     *
     * @param string $id
     *
     * @return object
     */
    public function deleteCollection($id)
    {
        $this->uri = "/v2/book/$id/collection";
        $this->type = "DELETE";
        return $this;
    }

    /**
     * @brief 获取某个用户的所有笔记(未测试)
     *
     * @param string $name
     *
     * @return object
     */
    public function userAnnotations($name)
    {
        $this->uri = "/v2/book/user/$name/annotations";
        $this->type = 'GET';
        return $this;
    }
    
    /**
     * @brief 获取某本图书的所有笔记(未测试)
     *
     * @param string $id
     *
     * @return object
     */
    public function bookAnnotations($id)
    {
        $this->uri = "/v2/book/user/$id/annotations";
        $this->type = 'GET';
        return $this;
    }
    
    /**
     * @brief 获取某篇笔记的信息(未测试)
     *
     * @param string $id
     *
     * @return object
     */
    public function getAnnotation($id)
    {
        $this->uri = "/v2/book/annotation/$id";
        $this->type = 'GET';
        return $this;
    }

    /**
     * @brief 用户给某本图书写笔记(未测试)
     *
     * @param string $id
     *
     * @return object
     */
    public function addAnnotation($id)
    {
        $this->uri = "/v2/book/$id/annotations";
        $this->type = "POST";
        return $this;
    }

    /**
     * @brief 用户修改某篇笔记(未测试)
     *
     * @param string $id
     *
     * @return object
     */
    public function editAnnotation($id)
    {
        $this->uri = "/v2/book/annotation/$id";
        $this->type = "PUT";
        return $this;
    }

    /**
     * @brief 用户删除某篇笔记(未测试)
     *
     * @param string $id
     *
     * @return object
     */
    public function deleteAnnotation($id)
    {
        $this->uri = "/v2/book/annotation/$id";
        $this->type = "DELETE";
        return $this;
    }
    /**
     * @brief 添加书评
     *
     * @return object
     */
    public function addReview()
    {
        $this->uri = "/v2/book/reviews";
        $this->type = 'POST';
        return $this;     
    }

    /**
     * @brief 修改书评
     *
     * @param string $id
     *
     * @return object
     */
    public function editReview($id)
    {
        $this->uri = "/v2/book/review/$id";
        $this->type = 'PUT';
        return $this;          
    }

    /**
     * @brief 删除书评
     *
     * @param string $id
     *
     * @return object
     */
    public function deleteReview($id)
    {
        $this->uri = "/v2/book/review/$id";
        $this->type = 'DELETE';
        return $this;          
    }
}
