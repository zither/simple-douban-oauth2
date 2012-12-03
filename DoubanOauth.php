<?php
/**
 * @file DoubanOauth.php
 * @brief 一个简单的豆瓣PHP Oauth2类
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.4
 * @date 2012-11-28
 */

class DoubanOauth {
    
    /**
     * @brief var 声明豆瓣OAUTH需要的最基本API链接
     */
    protected $authorizeUri = 'https://www.douban.com/service/auth2/auth';
    protected $accessUri = 'https://www.douban.com/service/auth2/token';
    protected $apiUri = 'https://api.douban.com';
            
    /**
     * @brief var 声明豆瓣OAUTH需要的APIKEY以及callback链接
     */
    protected $clientId, $secret, $redirectUri, $scope, $responseType;
    
    /**
     * @brief var 用于储存已获取的令牌
     */
    public $authorizeCode, $tokens, $accessToken, $refreshToken;
    
    /**
     * @brief 初始化豆瓣OAUTH，设置相关参数
     *
     * @param string $client_id
     * @param string $secret
     * @param string $redirect_uri
     * @param string $scope
     * @param string $responseType
     *
     * @return void
     */
    public function __construct($clientId, $secret, $redirectUri, $scope ='douban_basic_common', $responseType = 'code')
    {
        $this->clientId = $clientId;
        $this->secret = $secret;
        $this->redirectUri = $redirectUri;
        $this->scope = $scope;
        $this->responseType = $responseType;

        // API基类路径
        $basePath = __DIR__.'/api/Base.php';

        // 载入API基类
        try {
            $this->fileLoader($basePath);
        } catch(Exception $e) {
            echo 'Baseloader error:'.$e->getMessage();
        }
    }

    /**
     * @brief 跳转到豆瓣用户授权页面，获取AuthorizeCode
     *
     * @return Redirect
     */
    public function getAuthorizeCode()
    {
        // 获取AuthorizeCode请求链接
        $authorizeUrl = $this->getAuthorizeUrl();
        header('Location:'.$authorizeUrl);
    }
    
    /**
     * @brief 通过AuthorizeCode获取accessToken
     *
     * @return string
     */
    public function getAccessToken()
    {
        // 获取accessToken请求链接
        $accessUrl = $this->getAccessUrl();

        $header = array('Content_type: application/x-www-form-urlencoded');
        
        // 使用curl模拟请求，获取token信息
        $result = $this->curl($accessUrl, 'POST', $header);
        $this->tokens = json_decode($result);

        // 设置refreshToken,需要时可启用
        //$this->refreshToken = $this->tokens->refresh_token;

        // 设置Access_token
        return $this->accessToken = $this->tokens->access_token;
    }
    
    /**
     * @brief 请求豆瓣API,返回包含相关数据的对象
     *
     * @param object $API
     * @param array $data
     *
     * @return object
     */
    public function makeRequest($api, $data = null)
    {
        // API的完整URL
        $url = $this->apiUri.$api->uri;
        $header = $api->header;
        $type = $api->type;

        // 发送请求
        return $this->curl($url, $type, $header, $data);
    }
    
    /**
     * @brief 豆瓣API实例注册函数
     *
     * @param string $api
     *
     * @return object
     */
    public function apiRegister($api)
    {
        // 需要注册的API路径
        $apiPath = __DIR__.'/api/'.$api.'.php';

        try {
            $this->fileLoader($apiPath);
        } catch(Exception $e) {
            echo 'Apiloader error:'.$e->getMessage();
        }

        return new $api($this->clientId, $this->accessToken);
    }

    /**
     * @brief 生成豆瓣用户授权页面完整地址
     *
     * @return string
     */
    protected function getAuthorizeUrl()
    {
        $params = array(
                    'client_id' => $this->clientId,
                    'redirect_uri' => $this->redirectUri,
                    'response_type' => $this->responseType,
                    'scope' => $this->scope
                    );

        return $this->authorizeUri.'?'.http_build_query($params);
    }

    /**
     * @brief 生成豆瓣access_token完整获取链接
     *
     * @return string
     */
    protected function getAccessUrl()
    {

        $params = array(
                    'client_id' => $this->clientId,
                    'client_secret' => $this->secret,
                    'redirect_uri' => $this->redirectUri,
                    'grant_type' => 'authorization_code',
                    'code' => $this->authorizeCode,
                    );

        return $this->accessUri.'?'.http_build_query($params);
    }

    /**
     * @brief 使用CURL模拟请求，并返回取得的数据
     *
     * @param string $url
     * @param string $type
     * @param array $header
     * @param array $data
     *
     * @return object
     */
    protected function curl($url, $type, $header, $data = null)
    {
        $ch = curl_init();

        // 设置请求的URL链接
        curl_setopt($ch, CURLOPT_URL, $url);
        // 设置请求类型
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        // 设置请求Header信息
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        // 跳过证书验证
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
        // 返回响应内容
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 传递POST或PUT请求数据
        if ($type == 'POST' || $type =='PUT') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);            
        }

        $result = curl_exec($ch);

        curl_close($ch);  
        
        // 返回请求数据
        return $result;
    }
    
    /**
     * @brief 文件加载类
     *
     * @param string $path
     *
     * @return void
     */
    protected function fileLoader($path)
    {
        // 文件路径错误时抛出异常
        if ( ! file_exists($path)) {
            throw new Exception('The file you wanted to load does not exists.');
        }

        require $path;
    }
}
