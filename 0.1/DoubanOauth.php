<?php
/**
 * @file douban.php
 * @brief 初次学习Oauth，自写一个简单的豆瓣Oauth类，仅测试了winodws环境
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-09-13
 */

class DoubanOauth {
    
    /**
     * @brief var 声明豆瓣OAUTH需要的最基本API链接
     */
    protected static $authorizationUri = 'https://www.douban.com/service/auth2/auth';
        
    protected static $accessUri = 'https://www.douban.com/service/auth2/token';
            
    /**
     * @brief var 声明豆瓣OAUTH需要的APIKEY以及callback链接
     */
    protected static $clientId, $secret, $redirectUri;
    
    /**
     * @brief var 用于储存已获取的令牌
     */
    public static $authorizationCode, $tokens, $accessToken;
    
    /**
     * @brief 注册豆瓣OAUTH，初始化相关数据
     *
     * @param string $client_id
     * @param string $secret
     * @param string $redirect_uri
     *
     * @return void
     */
    public static function make($clientId, $secret, $redirectUri)
    {
        static::$clientId = $clientId;
        
        static::$secret = $secret;

        static::$redirectUri = $redirectUri;
    }

    /**
     * @brief 跳转到豆瓣用户授权页面，获取Authorization_code
     *
     * @return Redirect
     */
    public static function authorization()
    {
        // 获取Authorization_code请求链接
        $authorizationUrl = static::authorizationUrl();

        header('Location:'.$authorizationUrl);
    }
    
    /**
     * @brief 通过Authorization_code获取Access_token
     *
     * @return string
     */
    public static function access()
    {
        // 获取Access_token请求链接
        $accessUrl = static::accessUrl();
        
        // 在windows下测试，如果没有设置这个HEADER信息，会返回 411 length required error
        $header = array('Content-Length: ');
        
        // 使用curl模拟请求，获取token信息
        static::$tokens = static::curl($accessUrl, 'POST', $header);

        // 设置Access_token
        return static::$accessToken = static::$tokens->access_token;
    }

    /**
     * @brief 一个使用Access_token的例子，获取豆瓣用户数据
     *
     * @return object
     */
    public static function userInfo()
    {
        // 豆瓣用户API链接
        $userUrl = 'https://api.douban.com/v2/user/~me';

        // 通过header发送Access_token
        $header = array('Authorization: Bearer '.static::$accessToken);

        // 使用curl模拟请求，获取用户信息
        $userInfo = static::curl($userUrl, 'GET', $header);

        return $userInfo;
    }

    /**
     * @brief 生成豆瓣用户授权页面完整地址
     *
     * @return string
     */
    protected static function authorizationUrl()
    {
        return static::$authorizationUri.
            '?client_id='.static::$clientId.
            '&redirect_uri='.static::$redirectUri.
            '&response_type=code';
    }

    /**
     * @brief 生成豆瓣access_token完整获取链接
     *
     * @return string
     */
    protected static function accessUrl()
    {
        return static::$accessUri.
            '?client_id='.static::$clientId.
            '&client_secret='.static::$secret.
            '&redirect_uri='.static::$redirectUri.
            '&grant_type=authorization_code'.
            '&code='.static::$authorizationCode;
    }

    /**
     * @brief 使用CURL模拟GET和POST请求，并返回取得的数据
     *
     * @param string $url
     * @param string $type
     * @param array $header
     *
     * @return object
     */
    protected static function curl($url, $type, $header)
    {
        $ch = curl_init();
        
        // GET和POST请求区分设置请求方式
        if($type == 'GET'){
            curl_setopt($ch, CURLOPT_POST, 0);
        }else{
            curl_setopt($ch, CURLOPT_POST, 1);
        }

        // 设置相应的HEADER信息
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // 设置请求的URL链接
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);

        curl_close($ch);  
        
        // 返回Decode之后的数据
        return $result = json_decode($result);
    }
}
