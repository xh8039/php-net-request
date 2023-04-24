<?php

namespace request;

class Post extends Request
{
    /**
     * POST请求
     * @access public
     * @param string $url 请求URL
     * @param array|false $params 携带的数组参数
     * @param array $options 配置信息
     * @return response
     */
    public function __construct($url, $params = false, $options = [])
    {
        parent::__construct($options);
        return $this->post($url, $params);
    }
}