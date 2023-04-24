使用说明文档：[https://gitee.com/yh_IT/php_curl/wikis/pages](https://gitee.com/yh_IT/php_curl/wikis/pages)

## 1. 安装
使用Composer安装:
```
composer require curl/curl
```
或者下载源码手动安装。
## 2. 引入
```php
include 'Curl.php';
```
## 3. 创建Curl对象
```php
$curl = new Curl([
    'option1' => 'value1',
    'option2' => 'value2'
]);
```
可以传入可选选项数组设置CURL参数,如连接超时时间、代理等。
## 4. 设置请求头
```php 
$curl->header('header1', 'value1');
$curl->header('header2', 'value2');
```
## 5. 设置请求参数
```php
$curl->param('param1', 'value1');
$curl->param('param2', 'value2'); 
```
## 6. 发送请求
发送GET请求:
```php
$response = $curl->get('http://example.com');
```
发送POST请求:
```php  
$response = $curl->post('http://example.com'); 
```
## 7. 处理响应
获取响应状态码:
```php
$code = $response->code();
```
获取指定响应头:
```php
$content_type = $response->header('Content-Type');
```
获取所有响应头:
```php 
$headers = $response->headers();
```
获取JSON响应体 als 对象/数组:
```php
$data = $response->toObject();
$data = $response->toArray();
```
直接输出响应体:
```php
echo $response;
```
## 8. 完整示例
```php
include 'Curl.php';

$url = 'https://www.example.com';

$curl = new Curl();

$curl->header('User-Agent', 'Mozilla/5.0');

$response = $curl->get($url);

echo $response->code();
echo $response->header('Content-Type');

$data = $response->toObject();

echo $response;
```