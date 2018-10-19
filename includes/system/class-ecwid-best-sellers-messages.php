<?php
/**
 * Class Ecwid_Best_Sellers_Messages
 */

class Ecwid_Best_Sellers_Messages
{
	public static function show_messages() {
		add_action('admin_notices', [__CLASS__, 'admin_notices']);
		add_action('admin_notices', [__CLASS__, 'admin_errors']);
	}

	public static function add_notice($message = '')
	{
		$notices= get_option(ECWID_BEST_SELLERS_PLUGIN_BASENAME . '_admin_notices', []);
		$notices[]= $message;
		update_option(ECWID_BEST_SELLERS_PLUGIN_BASENAME . '_admin_notices', $notices);
	}

	public static function add_error($message = '')
	{
		$errors = get_option(ECWID_BEST_SELLERS_PLUGIN_BASENAME . '_admin_errors', []);
		$errors[]= $message;
		update_option(ECWID_BEST_SELLERS_PLUGIN_BASENAME . '_admin_errors', $errors);
	}

	private static function admin_notices() {
		if ($notices = get_option(ECWID_BEST_SELLERS_PLUGIN_BASENAME . '_admin_notices')) {
			foreach ($notices as $notice) {
				echo "<div class='updated'><p>$notice</p></div>";
			}
			delete_option(ECWID_BEST_SELLERS_PLUGIN_BASENAME . '_admin_notices');
		}
	}

	private static function admin_errors() {
		if ($errors = get_option(ECWID_BEST_SELLERS_PLUGIN_BASENAME . '_admin_errors')) {
			foreach ($errors as $error) {
				echo "<div class='error'><p>$error</p></div>";
			}
			delete_option(ECWID_BEST_SELLERS_PLUGIN_BASENAME . '_admin_errors');
		}
	}
}