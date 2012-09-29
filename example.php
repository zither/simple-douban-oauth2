<?php
/**
 * @file example.php
 * @brief Simple_douban_oauth2调用实例，内容为使用PUT请求更新用户书评。
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.2
 * @date 2012-09-29
 */

// 载入豆瓣Oauth类和API类
require 'DoubanOauth.php';
require 'DoubanAPI.php';

// 豆瓣应用public key
$clientId = 'Your app public key';

// 豆瓣应用secret key
$secret = 'Your app secret key';

// 用户授权后的回调链接
$callback = 'http://127.0.0.1/example.php';

// 设置应用需要的权限，Oauth类默认设置为douban_basic_common
$scope ='douban_basic_common';

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

// 用更新用户书评作为示例，$data为书评信息
$data = array(
        'title' => '三个故事',
        'content' => '三个故事并不是都市妖奇谈的正文，它们是可蕊在创作都市妖奇谈正文和捉鬼实习生的夹缝中完成的，但却是我读完都市妖奇谈后印象最为深刻的章节。也许是因为骨子里喜欢仙侠的缘故，当第一次读到这三个故事时惊喜不已。 

都市妖奇谈写的是都市中生活的一群妖怪的平常日子，尽管只是写妖怪们的喜怒哀乐，读起来却十分有趣。但是作为一个仙侠迷，我更希望这些故事发生在古代。 

可蕊在写完三个故事后写了这样一句话：追述这些故事的渊源，依旧是来自那些我自幼喜欢读的古代笔记体小说，正式那些妖怪鬼狐的故事，从小伴随着我长大，也是这些故事，给我打开了一扇完全不一样的窗口，以至于有了现在的都市妖奇谈。可是在我心底，还是有着一种想要更接近那些古代小说中的故事的渴望，于是，就有了三个故事。 

正是因为可蕊心中对古代小说的渴望，才让三个故事有了不一样的味道。三个故事里没有仙，只有善良的泥鳅、执着的僵尸以及可爱的狐狸，但是却让我读到了仙侠的气息。 

不得不承认，女生写的故事，也很好看。',
    );

// 生成一个豆瓣API基类实例
$API = new DoubanAPI();

// 选择修改评论API
$API = $API->reviewEdit('5599867',$accessToken);

// 使用豆瓣Oauth类向修改评论API发送请求，请获取返回结果
$result = $douban->send($API, $data);

// 打印结果
var_dump($result);
