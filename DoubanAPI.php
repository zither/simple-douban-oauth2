<?php
/**
 * @file DoubanAPI.php
 * @brief 豆瓣Oauth API注册类。
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.3
 * @date 2012-11-26
 */

class DoubanAPI {

    /**
     * @brief 储存已注册的api实例
     */
    protected $api;
    
    /**
     * @brief 自动载入api的Base类
     *
     * @return void
     */
    public function __construct()
    {
        // Base类路径
        $basePath = __DIR__.'/api/Base.php';

        // 载入Base类
        try {
            $this->fileLoader($basePath);
        } catch(Exception $e) {
            echo 'API load error:'.$e->getMessage();
        }
    }
    
    /**
     * @brief 注册指定api，并储存api实例
     *
     * @param string $api
     *
     * @return void
     */
    public function apiRegister($api)
    {
        $apiPath = __DIR__.'/api/'.$api.'.php';

        // 载入指定API
        try {
            $this->fileLoader($apiPath);
        } catch(Exception $e) {
            echo 'API load error:'.$e->getMessage();
        }

        $this->api = new $api();
    }
    
    /**
     * @brief 文件加载类
     *
     * @param string $path
     *
     * @return void
     */
    private function fileLoader($path)
    {
        if ( ! file_exists($path)) {
            throw new Exception('The API you wanted to load does not exists.');
        }

        require $path;
    }

    /**
     * @brief 通过魔术方法获取api实例
     *
     * @param string $name
     *
     * @return object
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

}
