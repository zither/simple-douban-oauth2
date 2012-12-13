<?php
/**
 * @file DoubanBook.php
 * @brief 豆瓣图书API
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-11
 */

class DoubanBook extends DoubanBase {
    
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
     * @brief 通过id获取书籍信息
     *
     * @param string $requestType GET
     * @param array $params 书籍id
     *
     * @return object
     */
    public function info($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/book/'.$params['id'];
        return $this;
    }
        
    /**
     * @brief 通过isbn获取书籍信息
     *
     * @param string $requestType GET
     * @param array $params 书籍isbn name
     *
     * @return object
     */
    public function isbn($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/book/isbn/'.$params['name'];
        return $this;
    }
       
    /**
     * @brief 图书搜索
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function search($requestType , $params)
    {
        $this->type = $requestType;
        if (!isset($params['q']) && !isset($params['tag']))
            throw new Exception('Need q or tag.');
        $this->uri = '/v2/book/search?'.http_build_query($params);
        return $this;
    }
    
    /**
     * @brief 获取图书中最多标签
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function bookTags($requestType,$params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/book/'.$params['id'].'/tags';
        return $this;    
    }
       
    /**
     * @brief 获取用户对图书的所有标签
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function userTags($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/book/user/'.$params['name'].'/tags';
        return $this;
    }
    
    /**
     * @brief 获取用户的所有图书收藏信息
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function collections($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/book/user/'.$params['name'].'/collections';
        return $this;
    }
        
    /**
     * @brief 操作用户对某本图书的收藏信息
     *
     * @param string $requestType GET,POST,PUT,DELETE
     * @param array $params
     *
     * @return object
     */
    public function collection($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/book/'.$params['id'].'/collection';
        return $this;
    }
    
    /**
     * @brief 获取用户的所有笔记
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function userAnnotations($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/book/user/'.$params['name'].'/annotations';
        return $this;
    }
     
    /**
     * @brief 获取某本图书的所有笔记
     *
     * @param string $requestType GET
     * @param array $params
     *
     * @return object
     */
    public function bookAnnotations($requestType, $params)
    {
        $this->type = $requestType;
        $this->uri = '/v2/book/'.$params['id'].'/annotations';
        return $this;
    }
    
    
    /**
     * @brief 操作用户对某本书的笔记信息
     *
     * @param string $requestType GET,POST,PUT,DELETE
     * @param array $params
     *
     * @return object
     */
    public function annotation($requestType, $params)
    {
        $this->type = $requestType;
        switch($this->type) {
            case 'GET':
            case 'PUT':
            case 'DELETE':
                $this->uri = '/v2/book/annotation/'.$params['id'];
                break;
            case 'POST':
                $this->uri = '/v2/book/'.$params['id'].'/annotations';
                break;
        }
        return $this;
    }
    
    /**
     * @brief 用户对书评相关操作
     *
     * @param string $requestType GET,POST,PUT,DELETE
     * @param array $params
     *
     * @return object
     */
    public function review($requestType, $params)
    {
        $this->type = $requestType;
        switch ($this->type) {
            case 'POST':
                $this->uri = '/v2/book/reviews';
                break;
            case 'PUT':
            case 'DELETE':
                $this->uri = '/v2/book/review/'.$params['id'];
                break;
        }
        return $this;
    }
}
