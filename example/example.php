<?php
/**
 * @file example.php
 * @brief Simple_douban_oauth2调用实例，内容为使用POST请求发表豆瓣广播。
 * @author JonChou <ilorn.mc@gmail.com>
 * @date 2012-12-17
 */
require dirname(__FILE__).'/vendor/autoload.php';

/* ------------实例化Oauth2--------------- */
$appConfig = array(
            // 必选参数，豆瓣应用public key。
            'client_id' => '037c0301d3b81d570a7409057b285805',
            // 必选参数，豆瓣应用secret key。
            'secret' => 'c2c9c36981ef49c6',
            // 必选参数，用户授权后的回调链接。
            'redirect_uri' => 'http://miniradio.com/douban/login',
            // 可选参数（默认为douban_basic_common），授权范围。
            'scope' => 'douban_basic_common,shuo_basic_r,shuo_basic_w',
            // 可选参数（默认为false），是否在header中发送accessToken。
            'need_permission' => true
            );
// 生成一个豆瓣Oauth类实例
$douban = new Douban\Oauth($appConfig);


/* ------------请求用户授权--------------- */

// 如果没有authorizeCode，跳转到用户授权页面
if ( ! isset($_GET['code'])) {
    $douban->requestAuthorizeCode();
    exit;
}
// 设置authorizeCode
$douban->setAuthorizeCode($_GET['code']);
// 通过authorizeCode获取accessToken，至此完成用户授权
$douban->requestAccessToken();


/* ------------发送图片广播--------------- */

// 通过豆瓣API发送一条带图片的豆瓣广播
// 我看到豆瓣API小组里很多朋友都卡在了发送图片广播上，那是因为没有设置正确的Content-Type。
// 在PHP中通过curl拓展上传图片必须使用类似“@/home/chou/images/123.png;type=image/png”的模式
// 并且必须在图片绝对路径后指定正确的图片类型，如果没有指定类型会返回“不支持的图片类型错误”。
// 那是因为没有指定图片类型时，上传的文件类型默认为“application/octet-stream”。
$data = array(
            'source' => $clientId, 
            'text' =>'Composer分支测试。', 
            'image' => '@/home/chou/Downloads/123.jpg;type=image/jpeg'
            );

$miniblog = $douban->api('Miniblog.statuses.POST');
$result = $douban->makeRequest($miniblog, $data);

// 使用豆瓣Oauth类向我说API发送请求，并获取返回结果
// 如果API需授权，请把makeRequest函数的第三个参数设置true
//$result = $douban->makeRequest($miniblog, $data, true);
?>

<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php var_dump($result); ?>
    </body>
</html>
