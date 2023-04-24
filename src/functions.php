<?php

namespace request\http;

/**
 * POST请求
 * @access public
 * @param string $url 请求URL
 * @param array|false $params 携带的数组参数
 * @param array $options 配置信息
 * @return response
 */
function post($url, $params = false, $options = [])
{
	return (new Post($options))->send($url, $params);
}

/**
 * Get请求
 * @access public
 * @param string $url 请求URL
 * @param array|false $params 携带的数组参数
 * @param array $options 配置信息
 * @return response
 */
function get($url, $params = false, $options = [])
{
	return (new Get($options))->send($url, $params);
}