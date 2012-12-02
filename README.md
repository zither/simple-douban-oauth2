simple-douban-oauth2
====================

一个简单的豆瓣oauth2客户端，现在的api还不完整，[项目文档](http://zither.github.com/simple-douban-oauth2)也才刚刚建立，不过都会不断完善。

[Dev](https://github.com/zither/simple-douban-oauth2/tree/dev)分支添加了完整的豆瓣API接口（未测试），新增接口还未添加注释。

###Simple Douban Oauth使用方法

由于看到很多朋友都不知道怎么上传带图片的豆瓣广播，所以特意在example文件中演示了一个使用POST方法发表图片豆瓣广播的例子。

    https://github.com/zither/simple-douban-oauth2/blob/master/example.php

**NOTICE:**需要注意到是例子中的代码只为演示，因此没有做任何过滤和有效性检查。

###添加API方法

simple douban oauth2现在的api还不完整，不过可以非常方便的添加。在**api**文件夹中保存了现有的豆瓣api，你可以选择你需要修改的API文件，或者参考例子编写自己需要的api类。

无需授权API的GET请求样式为：

    public function get($id)
    {
        $this->uri = '/v2/user/'.$id;

        return $this;
    }

需要授权API的GET请求样式为：

    public function me($accessToken)
    {
        $this->uri = '/v2/user/~me';

        // 必须在header中发送授权令牌
        $this->header = array('Authorization: Bearer '.$accessToken);

        return $this;
    }

API的POST请求样式为：

    public function add($accessToken)
    {
        $this->uri = "/v2/book/reviews";

        $this->header = array(
                'Content_type: application/x-www-form-urlencoded',
                'Authorization: Bearer '.$accessToken
                );

        // API默认请求设置为GET，因此这里需说明请求类型
        $this->type = 'POST';

        return $this;     
    }
