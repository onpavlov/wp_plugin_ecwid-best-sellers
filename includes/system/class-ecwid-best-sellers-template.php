<?php

namespace Ecwid\Best_Sellers;

/**
 * Class Template
 * @package Ecwid\Best_Sellers
 */
class Template
{
	private static $templatePath = '/wp-content/plugins/' . ECWID_BS_PLUGIN_BASENAME . '/templates/';

	public static function renderTemplate($template, $variables = [])
	{
		extract($variables);

		require_once $_SERVER['DOCUMENT_ROOT'] . self::$templatePath . $template . '.php';
	}
}