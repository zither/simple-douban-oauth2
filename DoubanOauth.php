<?php
/**
 * @file DoubanOauth.php
 * @brief 一个简单的豆瓣PHP Oauth2类
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.2
 * @date 2012-09-28
 */

class DoubanOauth {
    
    /**
     * @brief var 声明豆瓣OAUTH需要的最基本API链接
     */
    protected $authorizationUri = 'https://www.douban.com/service/auth2/auth';
        
    protected $accessUri = 'https://www.douban.com/service/auth2/token';

    protected $apiUri = 'https://api.douban.com';
            
    /**
     * @brief var 声明豆瓣OAUTH需要的APIKEY以及callback链接
     */
    protected $clientId, $secret, $redirectUri, $scope, $responseType;
    
    /**
     * @brief var 用于储存已获取的令牌
     */
    public $authorizationCode, $tokens, $accessToken;
    
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
    }

    /**
     * @brief 跳转到豆瓣用户授权页面，获取Authorization_code
     *
     * @return Redirect
     */
    public function authorization()
    {
        // 获取Authorization_code请求链接
        $authorizationUrl = $this->authorizationUrl();

        header('Location:'.$authorizationUrl);
    }
    
    /**
     * @brief 通过Authorization_code获取Access_token
     *
     * @return string
     */
    public function access()
    {
        // 获取Access_token请求链接
        $accessUrl = $this->accessUrl();
        
        // 在windows下测试，如果没有设置这个HEADER信息，会返回 411 length required error
        $header = array('Content_type: application/x-www-form-urlencoded');
        
        // 使用curl模拟请求，获取token信息
        $this->tokens = $this->curl($accessUrl, 'POST', $header);

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
    public function send($API, $data = null)
    {
        // API的完整URL
        $url = $this->apiUri.$API->uri;

        $header = $API->header;

        $type = $API->type;

        // 发送请求
        $result = $this->curl($url, $type, $header, $data);

        return $result;
    }

    /**
     * @brief 生成豆瓣用户授权页面完整地址
     *
     * @return string
     */
    protected function authorizationUrl()
    {
        return $this->authorizationUri.
            '?client_id='.$this->clientId.
            '&redirect_uri='.$this->redirectUri.
            '&response_type='.$this->responseType.
            '&scope='.$this->scope;
    }

    /**
     * @brief 生成豆瓣access_token完整获取链接
     *
     * @return string
     */
    protected function accessUrl()
    {
        return $this->accessUri.
            '?client_id='.$this->clientId.
            '&client_secret='.$this->secret.
            '&redirect_uri='.$this->redirectUri.
            '&grant_type=authorization_code'.
            '&code='.$this->authorizationCode;
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
        
        // 返回Decode之后的数据
        return $result = json_decode($result);
    }
}
