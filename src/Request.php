<?php

namespace network\http;

/**
 * @package network\http
 * @author  易航
 * @version dev
 * @link    https://gitee.com/yh-it/php-http-request
 */
trait Request
{

	/**
	 * cURL资源
	 */
	private $ch;

	/**
	 * 配置信息
	 * @return array
	 */
	private $options = [
		// 请求配置
		'request' => [
			'headers' => [
				'Accept' => '*/*',
				'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
				'Connection' => 'close',
				'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.102 Safari/537.36 Edg/104.0.1293.70'
			],
			'params' => []
		],
		// 配置信息
		'options' => [
			// 连接时间
			'connect_time' => 3,
			// 读取时间
			'read_time' => 5
		]
	];

	/**
	 * 构造函数,初始化请求配置
	 * 
	 * @param array $options 要设置的配置项  
	 */
	public function __construct($options = [])
	{
		if ((!empty($options)) && is_array($options)) {
			$this->options['options'] = array_merge($this->options['options'], $options);
		}
		return $this;
	}

	/**
	 * 初始化cURL请求
	 */
	private function init()
	{
		$headers_array = [];
		foreach ($this->options['request']['headers'] as $name => $value) {
			if (is_numeric($name)) {
				$content = explode(':', $value, 2);
				$name = $content[0];
				$value = $content[1];
			}
			$name = strtolower(trim($name));
			$value = trim($value);
			$headers_array[$name] = $value;
		}
		$headers = [];
		foreach ($headers_array as $name => $value) {
			$headers[] = $name . ': ' . $value;
		}
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($this->ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);  // 请求头
		curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->options['options']['connect_time']);  // 连接时间
		curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->options['options']['read_time']); // 请求时间
	}

	/**
	 * 设置请求头
	 * 
	 * @param string|array $name  请求头名称或数组
	 * @param string $value 请求头值  
	 * @return $this
	 */
	public function header($name, $value = false)
	{
		if (is_array($name) && (!empty($name))) {
			$this->options['request']['headers'] = array_merge($this->options['request']['headers'], $name);
		} else {
			$this->options['request']['headers'][$name] = $value;
		}
		return $this;
	}

	/**
	 * 设置请求参数
	 * 
	 * @param string|array $name  参数名称或数组 
	 * @param string $value 参数值  
	 * @return $this
	 */
	public function param($name, $value = false)
	{
		if (is_array($name) && (!empty($name))) {
			$this->options['request']['params'] = array_merge($this->options['request']['params'], $name);
		} else {
			$this->options['request']['params'][$name] = $value;
		}
		return $this;
	}

	/**
	 * 设置请求Cookie
	 * 
	 * @param string $value Cookie值  
	 * @return $this
	 */
	public function cookie($value)
	{
		return $this->header('cookie', $value);
	}

	/**
	 * 发送请求
	 * 
	 * @param string $url 请求URL  
	 * @return Response 响应对象
	 */
	private function sendRequest($url)
	{
		$this->init();
		curl_setopt($this->ch, CURLOPT_URL, $url);
		$response_body = curl_exec($this->ch);
		$http_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
		$header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
		curl_close($this->ch);
		$header = substr($response_body, 0, $header_size);
		$headers = explode(PHP_EOL, $header);
		// 过滤数组值两边的空格
		$headers = array_map('trim', $headers);
		// 过滤数组中的空值
		$headers = array_filter($headers);
		$body = substr($response_body, $header_size);
		$response = [
			'body' => $body,
			'header' => $header,
			'headers' => $headers,
			'code' => $http_code
		];
		return new Response($response);
	}
}
