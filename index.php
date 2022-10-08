<?php
include 'Curl.php';
$get = Curl::requestConfig([
	'param' => [
		'a' => 000,
		'b' => 333
	]
])::get('http://blog.bri6.cn');
print_r($get);
print_r(PHP_EOL);
print_r(Curl::$requset_content);
print_r(PHP_EOL . PHP_EOL);
$get = Curl::get('http://www.bri6.cn');
print_r($get);