# 轻HTTP请求库使用文档

## 安装

### 通过Composer安装

使用Composer安装网络请求库:

```shell
composer require network/http
```

此命令将自动下载网络请求库并安装到您的项目中。

### 通过自动加载使用

要使用网络请求库,还需要在代码中引入Composer的自动加载功能:

```php
require 'vendor/autoload.php';
```

该文件位于您的项目根目录下。只需要在第一次使用网络请求库的PHP文件中引入此文件,即可启用Composer自动加载。
之后,您就可以直接使用网络请求库了:

```php
$client = new network\http\Client();
```

无需再手动引入准备好的库文件。Composer自动加载会根据used时自动加载所需要的代码。

## 基本使用

详情见 [基本使用页面](readme/基本使用.md)。

## 助手函数

详情见 [助手函数页面](readme/助手函数.md)。

## 获取响应

详情见 [获取响应页面](readme/获取响应.md)。

## 显示响应体

详情见 [显示响应体页面](readme/显示响应体.md)。

## 错误与异常

详情见 [错误与异常页面](readme/错误与异常.md)。

我会持续更新文档,完整记录轻HTTP请求库的所有功能和用法。如果文档的任何部分不够详尽,请告知我。

希望这个简洁实用的轻HTTP请求库和配套文档能为广大 `PHP` 开发者提供更多便捷
