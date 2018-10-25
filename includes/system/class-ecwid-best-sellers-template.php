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
		self::$templatePath = $_SERVER['DOCUMENT_ROOT'] . self::$templatePath;
		extract($variables);

		require_once self::$templatePath . $template . '.php';
	}
}