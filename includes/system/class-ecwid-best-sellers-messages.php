<?php

namespace Ecwid\Best_Sellers;

/**
 * Class Messages
 * @package Ecwid\Best_Sellers
 */

class Messages
{
	public static function showMessages() {
		add_action('admin_notices', [__CLASS__, 'adminNotices']);
		add_action('admin_notices', [__CLASS__, 'adminErrors']);
	}

	/**
	 * @param string $message
	 */
	public static function addNotice($message = '')
	{
		$notices= get_option(ECWID_BS_PLUGIN_BASENAME . '_admin_notices', []);
		$notices[]= $message;
		update_option(ECWID_BS_PLUGIN_BASENAME . '_admin_notices', $notices);
	}

	/**
	 * @param string $message
	 */
	public static function addError($message = '')
	{
		$errors = get_option(ECWID_BS_PLUGIN_BASENAME . '_admin_errors', []);
		$errors[]= $message;
		update_option(ECWID_BS_PLUGIN_BASENAME . '_admin_errors', $errors);
	}

	public static function adminNotices() {
		if ($notices = get_option(ECWID_BS_PLUGIN_BASENAME . '_admin_notices')) {
			foreach ($notices as $notice) {
				echo "<div class='updated'><p>$notice</p></div>";
			}
			delete_option(ECWID_BS_PLUGIN_BASENAME . '_admin_notices');
		}
	}

	public static function adminErrors() {
		if ($errors = get_option(ECWID_BS_PLUGIN_BASENAME . '_admin_errors')) {
			foreach ($errors as $error) {
				echo "<div class='error'><p>$error</p></div>";
			}
			delete_option(ECWID_BS_PLUGIN_BASENAME . '_admin_errors');
		}
	}

	public static function clearAll()
	{
		delete_option(ECWID_BS_PLUGIN_BASENAME . '_admin_notices');
		delete_option(ECWID_BS_PLUGIN_BASENAME . '_admin_errors');
	}
}