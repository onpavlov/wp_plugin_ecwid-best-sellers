<?php

namespace Ecwid\Best_Sellers;

/**
 * Class Http_Helper
 * @package Ecwid\Best_Sellers
 */
class Http_Helper
{
	/**
	 * @param $url
	 * @param array $params
	 *
	 * @return array|\WP_Error
	 */
	public static function get($url, $params = [])
	{
		return wp_remote_get($url . self::makeQueryString($params));
	}

	/**
	 * @param $url
	 * @param array $params
	 *
	 * @return array|\WP_Error
	 */
	public static function post($url, $params = [])
	{
		return wp_remote_post($url,
			[
				'body' => json_encode($params),
				'timeout' => 20,
				'headers' => [
					'Content-Type' => 'application/json;charset="utf-8"'
				]
			]
		);
	}

	/**
	 * @param $params
	 *
	 * @return string
	 */
	private static function makeQueryString($params)
	{
		if (empty($params)) return '';

		return '?' . http_build_query($params);
	}
}