<?php
/**
 * @file Base.php
 * @brief 豆瓣api的Base类
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.3
 * @date 2012-11-27
 */

class Base {

    /**
     * @brief 豆瓣API uri
     */
    protected $uri;
    
    /**
     * @brief 设置默认请求为GET
     */
    protected $type = 'GET';
    
    /**
     * @brief 豆瓣应用public key
     */
    protected $clientId;
    
    /**
     * @brief 用户授权码
     */
    protected $accessToken;

    /**
     * @brief 设置默认请求Header信息
     */ 
    protected $header = array('Content-Length: ');
    
    /**
     * @brief 对接口需要的clientId和accessToken进行初始化
     *
     * @param string $clientId
     * @param string $accessToken
     *
     * @return 
     */
    protected function __construct($clientId, $accessToken)
    {
        $this->clientId = $clientId;
        $this->accessToken = $accessToken;
    }

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
