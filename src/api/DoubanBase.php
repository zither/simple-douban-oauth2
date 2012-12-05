<?php
/**
 * @file DoubanBase.php
 * @brief 豆瓣api的Base类
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-11-27
 */

class DoubanBase {

    /**
     * @brief 豆瓣API uri
     */
    protected $uri;
    
    /**
     * @brief API请求方式
     */
    protected $type;
    
    /**
     * @brief 豆瓣应用public key
     */
    protected $clientId;
    
    /**
     * @brief 使用魔术方法获取类属性
     *
     * @param mixed $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }
}
