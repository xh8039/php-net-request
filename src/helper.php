<?php

namespace network\http;

/**
 * POST请求
 * @access public
 * @param string $url 请求URL
 * @param array $params 携带的数组参数
 * @param array $headers 自定义请求头信息
 * @param array $options 配置信息
 * @return response
 */
function post(string $url, array $params = [], array $headers = [], array $options = [])
{
	return (new Client($options))->post($url, $params, $headers);
}

/**
 * Get请求
 * @access public
 * @param string $url 请求URL
 * @param array $params 携带的数组参数
 * @param array $headers 自定义请求头信息
 * @param array $options 配置信息
 * @return response
 */
function get(string $url, array $params = [], array $headers = [], array $options = [])
{
	return (new Client($options))->get($url, $params, $headers);
}