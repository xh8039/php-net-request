<?php

namespace network\http;

/**
 * POST请求
 * @access public
 * @param string $url 请求URL
 * @param array|false $params 携带的数组参数
 * @param array $headers 自定义请求头信息
 * @param array $options 配置信息
 * @return response
 */
function post($url, $params = false, $headers = [], $options = [])
{
	return (new Post($options))->send($url, $params, $headers);
}

/**
 * Get请求
 * @access public
 * @param string $url 请求URL
 * @param array|false $params 携带的数组参数
 * @param array $headers 自定义请求头信息
 * @param array $options 配置信息
 * @return response
 */
function get($url, $params = false, $headers = [], $options = [])
{
	return (new Get($options))->send($url, $params, $headers);
}