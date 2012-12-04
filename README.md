simple-douban-oauth2
====================

一个简单的豆瓣oauth2客户端，部分Api还未经过测试，[项目文档](http://zither.github.com/simple-douban-oauth2)也才刚刚建立，不过都会不断完善。

所有最新的修改都会直接上传到[Dev](https://github.com/zither/simple-douban-oauth2/tree/dev)分支。

###Simple Douban Oauth使用方法

由于看到很多朋友都不知道怎么上传带图片的豆瓣广播，所以特意在example文件中演示了一个使用POST方法发表图片豆瓣广播的例子。

    https://github.com/zither/simple-douban-oauth2/blob/master/example.php

**NOTICE:**需要注意到是例子中的代码只为演示，因此没有做任何过滤和有效性检查。

###添加API方法

simple douban oauth2现在的api还不完整，不过可以非常方便的添加。在**api**文件夹中保存了现有的豆瓣api，你可以选择你需要修改的API文件，或者参考例子编写自己需要的api类。

一个简单的豆瓣图书Api类作为示例：

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
