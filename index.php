<?php
include 'curl.php';
$curl = new curl;
$curl->requestConfig([
	'param' => [
		'a' => 000,
		'b' => 333
	]
]);

$get = $curl->get('http://blog.bri6.cn');
print_r($curl->responseContent);