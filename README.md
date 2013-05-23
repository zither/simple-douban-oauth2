simple-douban-oauth2
====================

一个简单的豆瓣oauth2客户端，基础Api已经测试完毕，为保证文档一致性，所有项目相关介绍都已转移到[项目文档](http://zither.github.com/simple-douban-oauth2)。

所有最新的修改都会直接上传到[Dev](https://github.com/zither/simple-douban-oauth2/tree/dev)分支。

还提供了Composer安装方式，你可以直接查看[Composer](https://github.com/zither/simple-douban-oauth2/tree/composer)分支了解更多信息。

###依赖

    PHP >= 5.2.0
    ext-curl
    ext-json

### 变更说明

豆瓣在更新API的过程中，从文档中删除了很多内容，比如发表电影评论，相册上传照片等。经过测试，暂时只是文档被删除，相关的接口现在还能用，并不保证接口一直有效。
豆瓣API之前变动比较大，特别是电影相关API，但是由于豆瓣API小组长期出于无人管理状态，很多问题得不到官方回应。
因此simple-douban-oauth2并未同步更新，API新接口相关功能暂时需要使用者自己添加，欢迎各位提交更新。

PS: 豆瓣相册大部分API接口已经无效，官方删除了大部分相册相关文档，同时从应用权限申请列表中移除了豆瓣相册权限。
