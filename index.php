<?php

require 'Curl.php';

$url = 'http://www.bri6.cn';

// 设置一个30秒的连接超时时间和20秒的读取超时时间
$curl = new request\Curl([
    'connect_time' => 30,
    'read_time' => 20
]);

// 设置请求头
$curl->header('User-Agent', 'Mozilla/5.0');

// 设置请求参数
$curl->param('key1', 'value1');
$curl->param('key2', 'value2');

// 发送GET请求 
$response = $curl->get($url);

// 打印响应状态码
echo $response->code();

// 打印指定响应头  
echo $response->header('Content-Type');

// 以数组形式打印所有响应头
print_r($response->headers());

// 如果响应是JSON,获取JSON对象
$data = $response->toObject();

// 直接输出响应体
echo $response;