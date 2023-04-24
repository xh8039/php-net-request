<?php

/**
 * @package network\http
 * @author  易航
 * @version 2.2
 * @link    https://gitee.com/yh-it/php-network-request
 *
 **/

namespace request\http\request;

class Method
{
	use Controller;

	/**
	 * GET请求
	 * @access public
	 * @param string $url 请求URL
	 * @param array|false $params 携带的数组参数
	 * @return response
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
	 * POST请求
	 * @access public
	 * @param string $url 请求URL
	 * @param array|false $params 携带的数组参数
	 * @return response
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
