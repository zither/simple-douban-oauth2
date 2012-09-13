<?php
/**
 * @file example.php
 * @brief 一个使用豆瓣OAUTH的简单例子
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-09-13
 */

// 包含豆瓣OAUTH类
require('douban.php');

// 豆瓣应用的Public Key
$client_id = 'Your app public key';

// 豆瓣应用的Secret Key
$secret = 'Your app secret key';

// 获取豆瓣授权令牌后的返回链接
$callback = 'http://127.0.0.1/example.php';

// 注册豆瓣OAUTH
Douban_oauth::make($client_id, $secret, $callback);

// 如果没有设置Authorization_code，跳转到豆瓣授权页面
if( ! isset($_GET['code']))
{
    // 跳转到豆瓣授权页面，获取Authorization_code
    Douban_oauth::authorization();

    exit;
}

// 设置Authorization_code
Douban_oauth::$authorization_code = $_GET['code'];

// 使用Authorization_code获取Access_token
Douban_oauth::access();

// 使用Access_token调用豆瓣API的例子
// 使用豆瓣用户API获取用户信息
Douban_oauth::user_info();
