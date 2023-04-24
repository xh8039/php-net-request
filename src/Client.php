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

	/**
	 * 发送GET请求
	 * 
	 * @param string|null $url 请求URL 
	 * @param array|false $params 请求参数,为空时为false
	 * @return Response 响应对象
	 */
	public function get($url = null, $params = false)
	{
		return $this->send('GET', $url, $params);
	}

	/**
	 * 发送POST请求
	 * 
	 * @param string|null $url 请求URL
	 * @param array|false $params 请求参数,为空时为false 
	 * @return Response 响应对象
	 */
	public function post($url = null, $params = false)
	{
		return $this->send('POST', $url, $params);
	}
}
