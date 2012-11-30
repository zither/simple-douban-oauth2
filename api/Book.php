<?php
/**
 * @file Book.php
 * @brief 豆瓣图书API
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.3
 * @date 2012-11-27
 */

class Book extends Base {

    /**
     * @brief 获取指定书籍
     *
     * @param int $id
     *
     * @return object
     */
    public function get($id)
    {
        $this->uri = '/v2/book/'.$id;

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
        $this->uri = '/v2/book/isbn/'.$name;

        return $this;
    }
    
    /**
     * @brief 获取书籍标签
     *
     * @param int $id
     *
     * @return object
     */
    public function tags($id)
    {
        $this->uri = '/v2/book/'.$id.'/tags';

        return $this;    
    }
    
    /**
     * @brief 添加书评
     *
     * @param string $accessToken
     *
     * @return object
     */
    public function add($accessToken)
    {
        $this->uri = "/v2/book/reviews";

        $this->header = array(
                'Content_type: application/x-www-form-urlencoded',
                'Authorization: Bearer '.$accessToken
                );

        $this->type = 'POST';

        return $this;     
    }

    /**
     * @brief 修改书评
     *
     * @param int $id
     * @param string $accessToken
     *
     * @return object
     */
    public function edit($accessToken, $id)
    {
        $this->uri = "/v2/book/review/$id";

        $this->header = array(
                'Content_type: application/x-www-form-urlencoded',
                'Authorization: Bearer '.$accessToken
                );

        $this->type = 'PUT';

        return $this;          
    }

}
