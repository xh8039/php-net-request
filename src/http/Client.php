<?php

namespace request\http;

use request\http\request\Method;

class Client extends Method
{
	/**
	 * 设置配置
	 * @param array $options 要设置的配置项
	 * @return \network\http\request\Method
	 */
	public function __construct($options = [])
	{
		parent::__construct($options);
	}
}