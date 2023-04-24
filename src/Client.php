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
	 * @param string $url 请求URL 
	 * @param array|false $params 请求参数,为空时为false
	 * @return Response 响应对象
	 */
	public function get($url, $params = false)
	{
		if (is_array($params)) $this->param($params);
		$this->ch = curl_init();
		if ($this->options['request']['params']) {
			$this->options['request']['params'] = http_build_query($this->options['request']['params']);
			$url = strstr($url, '?') ? trim($url, '&') . '&' .  $this->options['request']['params'] : $url . '?' .  $this->options['request']['params'];
		}
		return $this->sendRequest($url);
	}

	/**
	 * 发送POST请求
	 * 
	 * @param string $url 请求URL
	 * @param array|false $params 请求参数,为空时为false 
	 * @return Response 响应对象
	 */
	public function post($url, $params = false)
	{
		if (is_array($params)) $this->param($params);
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->options['request']['params']);
		return $this->sendRequest($url);
	}
}
