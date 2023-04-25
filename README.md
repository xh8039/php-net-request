# 轻HTTP请求库使用文档

^ 觉得本项目不错的话可以帮忙点一下星星Star哦

## 简介

轻HTTP请求库是一个简单轻量的PHP HTTP客户端，用于发送各种HTTP请求。它支持GET、POST、HEAD、DELETE、PUT、PATCH等方法，可以轻松发送JSON、XML等格式的数据。

该库的主要特性:

- 支持主流的HTTP方法：GET、POST、HEAD、DELETE、PUT、PATCH 等
- 支持URL参数、请求体、请求头、Cookie等设置  
- 发送请求体支持JSON、XML、文本等格式  
- 简单易用，代码量小巧轻量，使用方法灵活
- 基于PHP原生curl扩展，性能高效稳定

## 安装

### 通过Composer安装

使用Composer安装网络请求库:

```bash
composer require network/http:dev-master
```

此命令将自动下载网络请求库并安装到您的项目中。

### 通过自动加载使用

要使用网络请求库，还需要在代码中引入Composer的自动加载功能:

```php
require 'vendor/autoload.php';
```

该文件位于您的项目根目录下。只需要在第一次使用网络请求库的PHP文件中引入此文件，即可启用Composer自动加载。

启用之后，您就可以直接使用网络请求库了:

```php
$client = new network\http\Client();
```

无需再手动引入准备好的库文件。Composer自动加载会根据used时自动加载所需要的代码。

## 基本使用

```php
$client->param('name', '易航'); // 设置请求参数

$client->header('User-Agent', 'Mozilla/5.0'); // 设置请求头

$response = $client->get('http://www.bri6.cn'); // 发送GET请求

echo $response; // 输出响应体
```

详情见 [基本使用页面](readme/基本使用.md)。

## 助手函数

详情见 [助手函数页面](readme/助手函数.md)。

## 获取响应信息

详情见 [获取响应页面](readme/获取响应.md)。

## 显示响应体

详情见 [显示响应体页面](readme/显示响应体.md)。

## 错误与异常

详情见 [错误与异常页面](readme/错误与异常.md)。

## 其他

另外，如果需要对请求库进行定制开发,可以继承Client类并重写send()方法:

```php
namespace network\http;

class CustomClient extends Client 
{
    public function send($url, $params, $headers)
    {
        // 定制发送请求的逻辑
        // 调用parent::send($url, $params, $headers)发送请求
    }
}
```

然后通过 `new CustomClient()` 使用定制的客户端。

希望这个HTTP客户端库和使用文档能为您提供帮助！如果有任何问题请让我知道。

我会持续更新文档，完整记录轻HTTP请求库的所有功能和用法。如果文档的任何部分不够详尽，请告知我。

希望这个简洁实用的轻HTTP请求库和配套文档能为广大PHP开发者提供更多便捷
