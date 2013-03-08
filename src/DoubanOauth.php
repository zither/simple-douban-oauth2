<?php
/**
 * @file DoubanOauth.php
 * @brief 一个简单的豆瓣PHP Oauth2类
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.4
 * @date 2013-01-28
 */

if (!function_exists('curl_init')) {
    throw new Exception('Simple douban oauth2 needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('Simple douban oauth2 needs the JSON PHP extension.');
}

class DoubanOauth 
{    
    /**
     * @brief 豆瓣Oauth类头
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
     * @brief API请求链接
     */
    protected $apiUri = 'https://api.douban.com';
    
    /**
     * @brief API实例
     */
    protected $apiInstance;
    
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
     * @brief APP权限
     */
    protected $scope = 'douban_basic_common';
    
    /**
     * @brief 返回类型，默认使用code
     */
    protected $responseType = 'code';
    
    /**
     * @brief 用户授权码
     */
    protected $authorizeCode;

    /**
     * @brief 通过authorizeCode获得的访问令牌
     */
    protected $accessToken;

    /**
     * @brief 用于刷新accessToken
     */
    protected $refreshToken;

    /**
     * @brief 默认情况下，授权状态为false，不会在header中发送accessToken
     */
    protected $needPermission = false;

    /**
     * @brief curl默认设置  
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
     * @param array $config client_id, secret, redirect_uri, scope, need_permission, response_type
     *
     * @return void
     */
    public function __construct($config)
    {
        $this->clientId = $config['client_id'];
        $this->secret = $config['secret'];
        $this->redirectUri = $config['redirect_uri'];
        if (!empty($config['scope']))
            $this->scope = $config['scope'];
        if (!empty($config['need_permission']))
            $this->needPermission = $config['need_permission'];
        if (!empty($config['response_type']))
            $this->responseType = $config['response_type'];
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
        header('Location:' . $authorizeUrl);
        exit;
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
     * @brief 使用AuthorizeCode请求accessToken
     *
     * @return void
     */
    public function requestAccessToken()
    {
        $accessUrl = $this->accessUri;
        $header = $this->getDefaultHeader();
        $data = array(
                    'client_id' => $this->clientId,
                    'client_secret' => $this->secret,
                    'redirect_uri' => $this->redirectUri,
                    'grant_type' => 'authorization_code',
                    'code' => $this->authorizeCode,
                    );

        $result = json_decode($this->curl($accessUrl, 'POST', $header, $data));
        $this->refreshToken = $result->refresh_token;
        $this->accessToken = $result->access_token;
    }
    
    /**
     * @brief 设置accessToken
     *
     * @param string $accessToken
     *
     * @return void
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

        $doubanApi = self::PREFIX . ucfirst(strtolower($class));

        if (!($this->apiInstance instanceof $doubanApi)) {
            $apiFile = dirname(__FILE__) . '/api/' . $doubanApi . '.php';
            $basePath = dirname(__FILE__) . '/api/DoubanBase.php';
            try {
                $this->fileLoader($basePath);
                $this->fileLoader($apiFile);
            } catch(Exception $e) {
                echo 'Apiloader error:' . $e->getMessage();
            }
            $this->apiInstance = new $doubanApi($this->clientId);
        }

        $this->apiInstance->$func($type, $params);
        return $this;
    }

    /**
     * @brief 授权设置选项，访问需授权API时，请调用该函数。
     *
     * @return object
     */
    public function setNeedPermission($permissionStatus = true)
    {
        $this->needPermission = (boolean)$permissionStatus;
        return $this;
    }
    
    /**
     * @brief 获取API当前授权状态
     *
     * @return boolean
     */
    public function getNeedPermission()
    {
        return $this->needPermission;
    }

    /**
     * @brief 请求豆瓣API,返回包含相关数据的对象
     *
     * @param array $data
     *
     * @return string
     */
    public function makeRequest($data = array())
    {
        // API的完整Uri
        $url = $this->apiUri . $this->apiInstance->uri;
        $header = $this->needPermission ? $this->getAuthorizeHeader() : $this->getDefaultHeader();
        $type = $this->apiInstance->type;

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

        return $this->authorizeUri . '?' . http_build_query($params);
    }

    /**
     * @brief 获取HTTP默认请求头
     *
     * @return 
     */
    protected function getDefaultHeader()
    {
        return array('Content_type: application/x-www-form-urlencoded');
    }

    /**
     * @brief 获取HTTP授权请求头
     *
     * @return array
     */
    protected function getAuthorizeHeader()
    {
        return array('Authorization: Bearer ' . $this->accessToken);
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
        if ($type == 'POST' || $type == 'PUT') {
            $opts[CURLOPT_POSTFIELDS] = $data;
        }

        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            die('CURL error: ' . curl_error($ch));
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
            throw new Exception('The API file you wanted to load does not exists.');
        }
        require_once $path;
    }
}

