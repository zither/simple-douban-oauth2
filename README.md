simple-douban-oauth2
====================

一个简单的豆瓣oauth2客户端，部分Api还未经过测试，[项目文档](http://zither.github.com/simple-douban-oauth2)也才刚刚建立，不过都会不断完善。

所有最新的修改都会直接上传到[Dev](https://github.com/zither/simple-douban-oauth2/tree/dev)分支。

###依赖

    PHP >= 5.2.0
    ext-curl
    ext-json

###Composer包管理

Simple douban oauth2提供Composer快捷安装的方式，你可以直接查看[Composer](https://github.com/zither/simple-douban-oauth2/tree/composer)分支了解更多信息。

###Simple Douban Oauth使用方法

在example文件中演示了一个使用POST方法发表图片豆瓣广播的例子。

    ```php
    // 载入豆瓣Oauth类
    require '../src/DoubanOauth.php';

    /* ------------实例化Oauth2--------------- */

    // 豆瓣应用public key
    $clientId = '037c0301d3b81d570a7409057b285805';
    // 豆瓣应用secret key
    $secret = 'c2c9c36981ef49c6';
    // 用户授权后的回调链接
    $callback = 'http://localhost/example.php';
    // 设置应用需要的权限，Oauth类默认设置为douban_basic_common
    // 我们要发送豆瓣广播，就必须申请shuo_basic_w权限
    $scope ='douban_basic_common,shuo_basic_r,shuo_basic_w,community_advanced_doumail_r';
    // 生成一个豆瓣Oauth类实例
    $douban = new DoubanOauth($clientId, $secret, $callback, $scope);


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
    $data = array('source' => $clientId, 'text' =>'继续修改，继续测试。', 'image' => '@/home/chou/downloads/123.jpg;type=image/jpeg');
    // 发表广播需要用到豆瓣广播API，注册一个豆瓣广播API实例
    $miniblog = $douban->apiRegister('Miniblog');
    // 选择发表我说
    $miniblog->addMiniblog();
    // 使用豆瓣Oauth类向我说API发送请求，并获取返回结果
    $result = $douban->makeRequest($miniblog);
    ?>

    <html>
        <head>
            <meta charset="UTF-8">
        </head>
        <body>
            <?php var_dump($result); ?>
        </body>
    </html>
    ```

**NOTICE:**需要注意到是例子中的代码只为演示，因此没有做任何过滤和有效性检查。

###添加API方法

simple douban oauth2现在的api还不完整，不过可以非常方便的添加。在**api**文件夹中保存了现有的豆瓣api，你可以选择你需要修改的API文件，或者参考例子编写自己需要的api类。

一个简单的豆瓣图书Api类作为示例：
   ```php
    <?php

    class Book extends Base {
        
        // 初始化clientId，在uri后面添加apikey可以拥有更宽裕的请求次数
        public function __construct($clientId)
        {
            $this->clientId = $clientId;
        }

        // 无需授权的GET请求示例
        public function getBook($id)
        {
            // 没有添加apikey，单IP每分钟只能请求10次
            $this->uri = '/v2/book/'.$id;
            // 添加apikey之后，单IP每分钟可以请求40次
            // $this->uri = '/v2/book/'.$id.'?apikey='.$this->clientId;
            $this->type = 'GET';
            return $this;
        }

        // 需要授权的POST请求示例
        public function addReview()
        {
            $this->uri = "/v2/book/reviews";
            // API默认请求设置为GET，因此这里需说明请求类型
            $this->type = 'POST';
            return $this;     
        }        
    }
   ```
