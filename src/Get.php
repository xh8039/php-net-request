<?php

namespace network\http;

class Get extends Client
{

	/**
	 * GET请求初始化
	 * @access public
	 * @param array $options 配置信息
	 */
	public function __construct($options = [])
	{
		parent::__construct($options);
	}

	/**
	 * 发送GET请求
	 * @access public
	 * @param string $url 请求URL
	 * @param array|false $params 携带的数组参数
	 * @return response
	 */
	public function send($url, $params = false)
	{
		return $this->get($url, $params);
	}
}