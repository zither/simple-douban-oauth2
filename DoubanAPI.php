<?php
/**
 * @file DoubanAPI.php
 * @brief 豆瓣Oauth API，这里列出的并不完整，可以按需添加。
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.2
 * @date 2012-09-29
 */

class DoubanAPI {
    
    /**
     * @brief 豆瓣API uri
     */
    protected $uri;

    /**
     * @brief 设置默认请求为GET
     */
    protected $type = 'GET';

    /**
     * @brief 设置默认请求Header信息
     */ 
    protected $header = array('Content-Length: ');
    
    /**
     * @brief 豆瓣用户API，获取当前授权用户信息
     *
     * @param string $accessToken
     *
     * @return object
     */
    public function userMe($accessToken)
    {
        $this->uri = '/v2/user/~me';

        $this->header = array('Authorization: Bearer '.$accessToken);

        return $this;
    }
    
    /**
     * @brief 豆瓣用户API，获取指定ID用户信息
     *
     * @param string $id
     *
     * @return object
     */
    public function userGet($id)
    {
        $this->uri = '/v2/user/'.$id;

        return $this;
    }
    
    /**
     * @brief 豆瓣用户API，搜索用户
     *
     * @param string $q
     * @param int $start
     * @param int $count
     *
     * @return object
     */
    public function userSearch($q, $start, $count)
    {
        $this->uri = "/v2/user?q=$q&start=$start&count=$count";

        return $this;
    }
    
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
    public function reviewEdit($id, $accessToken)
    {
        $this->uri = "/v2/book/review/$id";

        $this->header = array(
                'Content_type: application/x-www-form-urlencoded',
                'Authorization: Bearer '.$accessToken
                );

        $this->type = 'PUT';

        return $this;          
    }

    /**
     * @brief 魔术方法，获取类属性
     *
     * @param mixed $var
     *
     * @return mixed
     */
    public function __get($var)
    {
        if (isset($this->$var)) {
            return $this->$var;
        }
    }
}
