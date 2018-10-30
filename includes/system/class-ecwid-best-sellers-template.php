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

		require $_SERVER['DOCUMENT_ROOT'] . self::$templatePath . $template . '.php';
	}

	/**
	 * @param $name
	 * @param $title
	 * @param $id
	 * @param $value
	 * @param string $style
	 */
	public static function getTextFieldHtml($name, $title, $id, $value, $style = '')
	{
		printf('<p><label for="%s">%s:<input style="%s" id="%s" name="%s" type="text" value="%s" /></label></p>',
			$name, $title, $style, $id, $name, $value
		);
	}

	public static function getSelectFieldHtml($name, $title, $id, $list, $value, $style = '')
	{
		$options = '';

		foreach ($list as $item) {
			$options .= '<option value="' . $item . '" ' . ($value == $item ? 'selected' : '') . ' >' . $item . '</option>';
		}

		printf('<p><label for="%s">%s:<select style="%s" id="%s" name="%s">%s</select></label></p>',
			$name, $title, $style, $id, $name, $options
		);
	}
}