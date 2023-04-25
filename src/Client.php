<?php

namespace network\http;

/**
 * @package network\http
 * @author  易航
 * @version dev
 * @link    https://gitee.com/yh-it/php-http-request
 */
class Client
{

	use Request;

	// public static function url($url)
	// {
	// 	return (new self)->url($url);
	// }

	/**
	 * 发送GET请求
	 * 
	 * @param string|null $url 请求URL 
	 * @param array $params 请求参数
	 * @param array $headers 自定义请求头信息
	 * @return Response 响应对象
	 */
	public function get($url = null, array $params = [], array $headers = [])
	{
		if (!empty($headers)) $this->header($headers);
		return $this->send(__FUNCTION__, $url, $params);
	}

	/**
	 * 发送POST请求
	 * 
	 * @param string|null $url 请求URL
	 * @param array $params 请求参数
	 * @param array $headers 自定义请求头信息
	 * @return Response 响应对象
	 */
	public function post($url = null, array $params = [], array $headers = [])
	{
		if (!empty($headers)) $this->header($headers);
		return $this->send(__FUNCTION__, $url, $params);
	}
}
