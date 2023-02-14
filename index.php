<?php
include 'Curl.php';
$url = 'http://blog.bri6.cn';
$response = (new request\Curl)->get($url);

// 获取响应头状态码
$response->code();

// 获取指定响应头信息
$response->header('date');

// 获取数组形式的所有响应头信息
$response->headers();

// 如果响应体是json格式那么获取PHP数组格式的响应体
$response->toArray();

// 如果响应体是json格式那么获取PHP对象格式的响应体
$response->toObject();

// 直接输出响应体
echo $response;