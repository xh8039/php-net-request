<?php

require __DIR__ . '/vendor/autoload.php';

$url = 'http://www.bri6.cn';
$get = network\request\http\get($url);
echo($get);
exit;

// 设置一个30秒的连接超时时间和20秒的读取超时时间
$request = new \network\http\Request([
    'connect_time' => 30,
    'read_time' => 20
]);

// 设置请求头
$request->header('User-Agent', 'Mozilla/5.0');

// 设置请求参数
$request->param('key1', 'value1');
$request->param('key2', 'value2');

// 发送GET请求 
$response = $request->get($url);

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