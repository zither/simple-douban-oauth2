<?php
/**
 * @file example.php
 * @brief Simple_douban_oauth2调用实例，内容为使用POST请求发表豆瓣广播。
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.4
 * @date 2012-12-01
 */

// 载入豆瓣Oauth类
require 'DoubanOauth.php';

// 豆瓣应用public key
$clientId = 'Your public key';

// 豆瓣应用secret key
$secret = 'Your secret key';

// 用户授权后的回调链接
$callback = 'http://localhost/example.php';

// 设置应用需要的权限，Oauth类默认设置为douban_basic_common
// 我们要发送豆瓣广播，就必须申请shuo_basic_w权限
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

// 通过豆瓣API发送一条带图片的豆瓣广播
// 我看到豆瓣API小组里很多朋友都卡在了发送图片广播上，那是因为没有设置正确的Content-Type。
// 在PHP中通过curl拓展上传图片必须使用类似“@/home/chou/images/123.png;type=image/png”的模式
// 并且必须在图片绝对路径后指定正确的图片类型，如果没有指定类型会返回“不支持的图片类型错误”。
// 那是因为没有指定图片类型时，上传的文件类型默认为“application/octet-stream”。
$data = array('source' => $clientId, 'text' =>'更换了header信息，再次通过豆瓣API发表广播。', 'image' => '@/home/chou/images/123.png;type=image/png');

// 发表广播需要用到豆瓣广播API，注册一个豆瓣广播API实例
$Miniblog = $douban->apiRegister('Miniblog');

// 选择我说API
$Miniblog->shuo($accessToken);

// 使用豆瓣Oauth类向我说API发送请求，并获取返回结果
$result = $douban->send($Miniblog, $data);

// 打印结果,返回的$result已经经过json_decode操作
var_dump($result);
