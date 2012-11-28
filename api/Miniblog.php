<?php
/**
 * @file Miniblog.php
 * @brief 豆瓣广播API
 * @author JonChou <ilorn.mc@gmail.com>
 * @version 0.1
 * @date 2012-11-29
 */

class Miniblog extends Base {

    /**
     * @brief 发送一条豆瓣广播
     *
     * @param string $accessToken
     *
     * @return object
     */
    public function shuo($accessToken)
    {
        $this->uri = '/shuo/v2/statuses/';

        $this->header = array(
                'Content_type: multipart/form-data',
                'Authorization: Bearer '.$accessToken
                );

        $this->type = 'POST';

        return $this;   
    }
    
}
