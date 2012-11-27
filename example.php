<?php
/**
 * @file example.php
 * @brief Simple_douban_oauth2调用实例，内容为使用PUT请求更新用户书评。
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.3
 * @date 2012-11-27
 */

// 载入豆瓣Oauth类和API类
require 'DoubanOauth.php';
require 'DoubanAPI.php';

// 豆瓣应用public key
$clientId = 'Your public key';

// 豆瓣应用secret key
$secret = 'Your secret key';

// 用户授权后的回调链接
$callback = 'http://localhost/example.php';

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

// $data为需要修改的书评信息，title为评论标题，content为评论内容。
// 当你在测试API时，请选择你自己发表过的书评，示例只用作示范，否则会返回未授权错误。
$data = array(
        'title' => '天地铜炉',
        'content' => '作为众多精品残卷中的一员，乱世铜炉还算让人欣慰，最起码十三讲完了铜炉前传。当初在读乱世铜炉时也只是看完了铜炉前传便果断放手，正传的残本一直到现在都未品读。有时放弃也是一种幸福，没必要去跳那些永远不填的大坑。又是十三在《关于铜炉中的一些问题的回答》中填了一首词：
西江月 藏头 天地铜炉
乱雪横摧江渡，世值三九日暮，铜棹铁舟孤江上，炉台冷香烧烬。
又独临水凭舷，是景江涛如怒，十里霜风劲吹满，三岸落枝无数！
就如词中所写，整个铜炉前传都笼罩在一种无力感中，让人看不到希望。主角胡不为只是一个普通的村民，偶然学得一些风水堪舆的本事，在穷山僻壤的山村里充充道士，悠悠自得。但就是这样一个卑微的人物却被卷入了他无法自已的争斗之中，只是因为一时贪心拾了一枚青龙镇煞钉。
乱世铜炉里的人物仿佛就是作者用来虐心的。道行高深的狐狸单嫣心底善良到被无耻道人一再欺辱伤害，名门弟子秦苏单纯到一再被外人和同门欺骗，玉女峰掌门隋真凤硬生生把心爱弟子逼得走投无路叛出门派。当胡不为在江湖上混得了一些“威名”后，好不容易看到一丝希望时又被隋真凤收去了精魂，落得一个神智不清的下场。
好在前传的结尾并不凄凉，甚至可以称得上圆满。坚韧的秦苏终于守到胡不为恢复神智，小胡碳也初显聪慧。那么就让乱世铜炉的故事一直停留在这里好了。',
    );

// 生成一个豆瓣API基类实例
$API = new DoubanAPI();

// 注册一个豆瓣图书API实例
$API->apiRegister('BookAPI');

// 选择修改评论
$API->api->reviewEdit($accessToken, '5671382');

// 使用豆瓣Oauth类向添加评论API发送请求，并获取返回结果
$result = $douban->send($API->api, $data);

// 打印结果,返回的$result已经经过json_decode操作
var_dump($result);
