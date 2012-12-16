<?php
/**
 * @file DoubanOauth.php
 * @brief 一个简单的豆瓣PHP Oauth2类
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.4
 * @date 2012-12-13
 */

if (!function_exists('curl_init')) {
    throw new Exception('Simple douban oauth2 needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('Simple douban oauth2 needs the JSON PHP extension.');
}

class DoubanOauth {
    
    /**
     * @brief 豆瓣Oauth类词头
     */
    const PREFIX = 'Douban';

    /**
     * @brief authorizeCode请求链接
     */
    protected $authorizeUri = 'https://www.douban.com/service/auth2/auth';
    
    /**
     * @brief accessToken请求链接
     */
    protected $accessUri = 'https://www.douban.com/service/auth2/token';
    
    /**
     * @brief api请求链接
     */
    protected $apiUri = 'https://api.douban.com';
                
    /**
     * @brief 豆瓣应用public key
     */
    protected $clientId;
    
    /**
     * @brief 豆瓣应用secret key
     */
    protected $secret;

    /**
     * @brief callback链接
     */
    protected $redirectUri;

    /**
     * @brief Api权限
     */
    protected $scope;
    
    /**
     * @brief 返回类型，默认使用code
     */
    protected $responseType;
    
    /**
     * @brief 用户授权码
     */
    protected $authorizeCode;

    /**
     * @brief 储存返回的令牌（accessToken,refreshToken）
     */
    protected $tokens;

    /**
     * @brief 通过authorizeCode获得的访问令牌
     */
    protected $accessToken;

    /**
     * @brief 用于刷新accessToken
     */
    protected $refreshToken;

    /**
     * @var 默认请求头信息 
     */
    protected $defaultHeader = array(
                'Content_type: application/x-www-form-urlencoded'
                );

    /**
     * @var 需授权的请求头
     */
    protected $authorizeHeader;
    
    /**
     * @var curl默认设置  
     */
    protected $CURL_OPTS = array(
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_TIMEOUT        => 60,
                CURLOPT_USERAGENT      => 'simple-douban-oauth2-0.4',
                );

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
     * @brief 跳转到豆瓣用户授权页面，获取AuthorizeCode
     *
     * @return redirect
     */
    public function requestAuthorizeCode()
    {
        // 获取AuthorizeCode请求链接
        $authorizeUrl = $this->getAuthorizeUrl();
        header('Location:'.$authorizeUrl);
    }
    
    /**
     * @brief 设置AuthorizeCode
     *
     * @param string $authorizeCode
     *
     * @return void
     */
    public function setAuthorizeCode($authorizeCode)
    {
        $this->authorizeCode = $authorizeCode;
    }

    /**
     * @brief 通过AuthorizeCode获取accessToken
     *
     * @return string
     */
    public function requestAccessToken()
    {
        $accessUrl = $this->accessUri;
        $header = $this->defaultHeader;
        $data = array(
                    'client_id' => $this->clientId,
                    'client_secret' => $this->secret,
                    'redirect_uri' => $this->redirectUri,
                    'grant_type' => 'authorization_code',
                    'code' => $this->authorizeCode,
                    );

        $result = $this->curl($accessUrl, 'POST', $header, $data);
        $this->tokens = json_decode($result);
        $this->refreshToken = $this->tokens->refresh_token;
        $this->accessToken = $this->tokens->access_token;
    }
    
    /**
     * @brief 设置accessToken
     *
     * @param string $accessToken
     *
     * @return object
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @brief 获取accessToken
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @brief 注册豆瓣Api
     *
     * @param string $api
     * @param array $params
     *
     * @return object
     */
    public function api($api, $params = array())
    {
        $info = explode('.', $api);
        $class = $info[0];
        $func = $info[1];
        $type = strtoupper($info[2]);

        $doubanApi = self::PREFIX.ucfirst(strtolower($class));
        // 豆瓣Api路径
        $apiFile = dirname(__FILE__).'/api/'.$doubanApi.'.php';
        // 豆瓣Api基类路径
        $basePath = dirname(__FILE__).'/api/DoubanBase.php';
        
        try {
            $this->fileLoader($basePath);
            $this->fileLoader($apiFile);
        } catch(Exception $e) {
            echo 'Apiloader error:'.$e->getMessage();
        }

        $instance = new $doubanApi($this->clientId);
        return $instance->$func($type, $params);
    }

    /**
     * @brief 请求豆瓣API,返回包含相关数据的对象
     *
     * @param object $API
     * @param array $data
     * @param boolean 为true时会在header中发送accessToken
     *
     * @return object
     */
    public function makeRequest($api, $data = array(), $authorization = false)
    {
        // API的完整URL
        $url = $this->apiUri.$api->uri;
        $header = $authorization ? $this->getAuthorizeHeader() : $this->defaultHeader;
        $type = $api->type;

        return $this->curl($url, $type, $header, $data);
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
     * @brief 获取Authorization header
     *
     * @return array
     */
    protected function getAuthorizeHeader()
    {
        return $this->authorizeHeader = array('Authorization: Bearer '.$this->accessToken);
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
    protected function curl($url, $type, $header, $data = array())
    {
        $opts = $this->CURL_OPTS;
        $opts[CURLOPT_URL] = $url;
        $opts[CURLOPT_CUSTOMREQUEST] = $type;
        $header[] = 'Expect:'; 
        $opts[CURLOPT_HTTPHEADER] = $header;
        if ($type == 'POST' || $type =='PUT') {
            $opts[CURLOPT_POSTFIELDS] = $data;
        }

        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            die('CURL error: '.curl_error($ch));
        }

        curl_close($ch);  
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
