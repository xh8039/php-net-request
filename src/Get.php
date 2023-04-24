<?php

namespace network\http;

/**
 * @package network\http
 * @author  易航
 * @version dev
 * @link    https://gitee.com/yh-it/php-http-request
 */
class Get extends Client
{

	/**
	 * 构造函数,初始化GET请求  
	 * 
	 * @param array $options 请求配置
	 */
	public function __construct($options = [])
	{
		parent::__construct($options);
	}

	/**
	 * 发送GET请求
	 *  
	 * @param string $url 请求URL
	 * @param array|false $params 请求参数,为空时为false
	 * @param array $headers 自定义请求头
	 * @return Response 响应对象 
	 */
	public function send($url, $params = false, $headers = [])
	{
		$this->header($headers);
		return $this->get($url, $params);
	}
}