<?php
/**
 * @file example.php
 * @brief Simple_douban_oauth2调用实例，内容为使用POST请求发表豆瓣广播。
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.4
 * @date 2012-11-28
 */

// 载入豆瓣Oauth类和API类
require 'DoubanOauth.php';

// 豆瓣应用public key
$clientId = 'Your public key';

// 豆瓣应用secret key
$secret = 'Your secret key';

// 用户授权后的回调链接
$callback = 'http://localhost/example.php';

// 设置应用需要的权限，Oauth类默认设置为douban_basic_common
$scope ='douban_basic_common,shuo_basic_w';

// 生成一个豆瓣Oauth类实例
$douban = new DoubanOauth($clientId, $secret, $callback, $scope);

// 如果没有authorizationCode，跳转到用户授权页面
if ( ! isset($_GET['code'])) {
    $douban->authorization();
    exit;
}

// 设置authorizationCode
$douban->authorizationCode = $_GET['code'];

// 通过authorizationCode获取accessToken
$accessToken = $douban->access();

// 通过豆瓣API发送一条豆瓣广播
$data = array('source' =>$clientId, 'text' =>'更换了header信息，再次通过豆瓣API发表广播。');

// 修改评论需要用到豆瓣图书API，注册一个豆瓣图书API实例
$bookAPI = $douban->apiRegister('Miniblog');

// 选择修改评论API
$bookAPI->shuo($accessToken);

// 使用豆瓣Oauth类向修改评论API发送请求，并获取返回结果
$result = $douban->send($bookAPI, $data);

// 打印结果,返回的$result已经经过json_decode操作
var_dump($result);
