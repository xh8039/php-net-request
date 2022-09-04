<?php

class curl
{
	public $ch;

	/**
	 * 请求配置
	 * @access public
	 * @return array
	 */
	public $requsetConfig = [
		'header' => [
			'Accept: */*',
			'Accept-Encoding: gzip,deflate,sdch',
			'Accept-Language: zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
			'Connection:close',
			'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.5112.102 Safari/537.36 Edg/104.0.1293.70'
		],
		'param' => null,
		'cookie' => null,
		// 连接时间
		'connect_time' => 30,
		// 读取时间
		'read_time' => null
	];

	/**
	 * 请求成功后响应内容
	 * @access public
	 * @return array
	 */
	public $responseContent = [];

	public function __construct()
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($this->ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
	}

	/**
	 * 配置请求参数
	 * @access public
	 * @param array $config 要配置的数组请求参数
	 * @return $this
	 */
	public function requestConfig($config)
	{
		foreach ($config as $key => $value) {
			if (!empty($value)) {
				$this->requsetConfig[$key] = $value;
			}
		}
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->requsetConfig['header']);  // 请求头
		curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->requsetConfig['connect_time']);  // 请求时间
		curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->requsetConfig['read_time']); // 读取时间
		return $this;
	}

	/**
	 * GET请求
	 * @access public
	 * @param string $url 请求URL
	 * @return mixed
	 */
	public function get($url)
	{
		$this->requsetConfig['param'] = http_build_query($this->requsetConfig['param']);
		$url = strstr($url, '?') ? trim($url, '&') . '&' .  $this->requsetConfig['param'] : $url . '?' .  $this->requsetConfig['param'];
		return $this->request($url);
	}

	/**
	 * POST请求
	 * @access public
	 * @param string $url 请求URL
	 * @return mixed
	 */
	public function post($url)
	{
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->requsetConfig['param']);
		return $this->request($url);
	}

	/**
	 * 处理请求
	 * @access public
	 * @param string $url 请求URL
	 * @return mixed
	 */
	private function request($url)
	{
		curl_setopt($this->ch, CURLOPT_URL, $url);
		$response_body = curl_exec($this->ch);
		$header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
		$header = substr($response_body, 0, $header_size);
		$header_explode = explode(PHP_EOL, $header);
		$header_explodes = [];
		$header_array = [];
		foreach ($header_explode as $value) {
			if ((empty($value) && ($value != 0)) || (empty(strlen($value)))) {
				continue;
			}
			$value = trim($value);
			$header_explodes[] = $value;
			if (strpos($value, ':')) {
				preg_match('/(.*):(.*)/ims', $value, $header_text);
				$header_array[trim($header_text[1])] = trim($header_text[2]);
			} else {
				$header_array[] = $value;
			}
		}
		$headers = [
			$header,
			$header_explodes,
			$header_array
		];
		$body = substr($response_body, $header_size);
		$results = [
			'body' => $body, 'header' => $headers, 'code' => curl_getinfo($this->ch, CURLINFO_HTTP_CODE),
		];
		curl_close($this->ch);
		$this->responseContent = $results;
		$this->ch = curl_init();
		return $results['body'];
	}
}
