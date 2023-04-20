<?php

namespace request;

class Response
{
    private $response;

    private $headers = null;

    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * 直接获取响应体内容
     * @return string
     */
    public function __toString()
    {
        return $this->body();
    }

    /**
     * 直接获取响应体内容
     * @return string
     */
    public function body()
    {
        return $this->response['body'];
    }

    /**
     * 获取响应状态码
     * @return integer
     */
    public function code()
    {
        return trim($this->response['code']);
    }

    /**
     * 获取指定响应头信息
     * @access public
     * @param $name 响应头名称
     * @return string
     */
    public function header($name)
    {
        $headers = $this->headers();
        $name = strtolower(trim($name));
        return isset($headers[$name]) ? $headers[$name] : null;
    }

    /**
     * 获取数组形式的所有响应头信息
     * @return array
     */
    public function headers()
    {
        if (is_null($this->headers)) {
            $this->headers = $this->explodeHeaders($this->response['headers']);
        }
        return $this->headers;
    }

    /**
     * 将获取到的JSON数据转换为PHP数组
     * @access public
     * @return array|string
     */
    public function toArray()
    {
        $array = json_decode($this->response['body'], true);
        if (is_array($array)) {
            return $array;
        }
        return $this->body();
    }

    /**
     * 将获取到的JSON数据转换为PHP对象
     * @access public
     * @return object|string
     */
    public function toObject()
    {
        $object = json_decode($this->response['body']);
        if (is_object($object)) {
            return $object;
        }
        return $this->body();
    }

    private function explodeHeaders(array $headers)
    {
        $headers_array = [];
        // $headers[] = 'data : :aa:bb: ';
        foreach ($headers as $value) {
            if (strpos($value, ':')) {
                $value = explode(':', $value, 2);
                $headers_array[strtolower(trim($value[0]))] = trim($value[1]);
            } else {
                $headers_array[] = $value;
            }
        }
        return $headers_array;
    }
}
