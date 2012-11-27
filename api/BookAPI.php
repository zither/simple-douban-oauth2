<?php
/**
 * @file BookAPI.php
 * @brief 豆瓣图书API
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.3
 * @date 2012-11-27
 */

class BookAPI extends Base {

    /**
     * @brief 豆瓣图书API，获取指定书籍
     *
     * @param int $id
     *
     * @return object
     */
    public function bookGet($id)
    {
        $this->uri = '/v2/book/'.$id;

        return $this;
    }
    
    /**
     * @brief 豆瓣图书API,获取Isbn对应书籍
     *
     * @param string $name
     *
     * @return object
     */
    public function bookIsbn($name)
    {
        $this->uri = '/v2/book/isbn/'.$name;

        return $this;
    }
    
    /**
     * @brief 豆瓣图书API，获取书籍标签
     *
     * @param int $id
     *
     * @return object
     */
    public function bookTags($id)
    {
        $this->uri = '/v2/book/'.$id.'/tags';

        return $this;    
    }
    
    /**
     * @brief 豆瓣图书API，添加书评
     *
     * @param string $accessToken
     *
     * @return object
     */
    public function reviewAdd($accessToken)
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
     * @brief 豆瓣图书API，修改书评
     *
     * @param int $id
     * @param string $accessToken
     *
     * @return object
     */
    public function reviewEdit($accessToken, $id)
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
