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
			// 请求头参数
			'headers' => [
				'Accept' => '*/*',
				'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
				'Connection' => 'close',
				'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.102 Safari/537.36 Edg/104.0.1293.70'
			],
			// 请求携带参数
			'params' => [],
			'url' => null
		],
		// 配置信息
		'options' => [
			// 连接时间
			'connect_time' => 3,
			// 读取时间
			'read_time' => 5,
			// 用于全局指定基础URL,会自动拼接到所有请求URL前面。一旦设置,客户端发出的所有请求URL都会基于这个基础URL。
			'base_url' => null
		]
	];

	/**
	 * 响应资源
	 */
	public $response;

	/**
	 * 构造函数,初始化请求配置
	 * 
	 * @param array $options 要设置的配置项  
	 */
	public function __construct(array $options = [])
	{
		if ((!empty($options)) && is_array($options)) {
			$this->options['options'] = array_merge($this->options['options'], $options);
		}
		return $this;
	}

	/**
	 * 初始化cURL请求
	 */
	private function _init(string $url, string $method)
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
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false); //终止从服务端进行验证
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false); //终止从服务端进行验证
		curl_setopt($this->ch, CURLOPT_ENCODING, ''); //自动发送所有支持的编码类型
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true); //返回原生的（Raw）输出
		curl_setopt($this->ch, CURLOPT_HEADER, 1); //将头文件的信息作为数据流输出
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);  //设置请求头
		//在发起连接前等待的时间，如果设置为0，则无限等待。
		curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->options['options']['connect_time']);
		curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->options['options']['read_time']); //设置cURL允许执行的最长秒数
		$method = strtoupper($method);
		$params = $this->options['request']['params'];
		if ($method == 'GET' && (!empty($params))) {
			$params = http_build_query($params);
			$url = strstr($url, '?') ? trim($url, '&') . '&' .  $params : $url . '?' .  $params;
		}
		if ($method == 'POST') {
			curl_setopt($this->ch, CURLOPT_POST, 1);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, empty($params) ? [] : $params);
		}
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $method);
	}

	private function getFullUrl($url = null)
	{
		$url = empty($url) ? $this->options['request']['url'] : $url;
		$this->url($url);
		$url = empty($this->options['options']['base_url']) ? $url : ($this->options['options']['base_url'] . $url);
		return $url;
	}

	public function url(string $url)
	{
		$this->options['request']['url'] = $url;
		return $this;
	}

	/**
	 * 设置请求头
	 * 
	 * @param string|array $name  请求头名称或数组
	 * @param string $value 请求头值  
	 * @return $this
	 */
	public function header($name, $value = null)
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
	public function param($name, $value = null)
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
	public function cookie(string $value)
	{
		return $this->header('cookie', $value);
	}

	/**
	 * 发送请求
	 * 
	 * @param string $method 请求方法
	 * @param string|null $url 请求URL
	 * @param array|false $params 请求参数
	 * @return Response 响应对象
	 */
	public function send(string $method, $url = null, $params = false)
	{
		$url = $this->getFullUrl($url);
		if (is_array($params) && (!empty($params))) $this->param($params);

		$this->_init($url, $method);

		$response_body = curl_exec($this->ch);
		$http_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
		$header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
		curl_close($this->ch);

		$response = $this->response = new Response($http_code, $header_size, $response_body);
		// curl_close($this->ch);
		return $response;
	}
}
