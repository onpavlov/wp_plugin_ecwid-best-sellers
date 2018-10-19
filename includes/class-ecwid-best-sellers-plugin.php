<?php

class Ecwid_Best_Sellers_Plugin
{
	const ECWID_MAIN_PLUGIN = 'ecwid-shopping-cart/ecwid-shopping-cart.php';

	public static function activate()
	{
		if (!self::is_ecwid_main_plugin_active()) {
			WP_die(sprintf(__('<a href="%s"><-- Back</a><br><br><p style="text-align: center">You should install and activate <a href="%s" target="_blank">Ecwid Shopping Cart</a> plugin</p>', 'ecwid-best-sellers'), wp_get_referer(), 'https://wordpress.org/plugins/ecwid-shopping-cart/'));
		} else {
			Ecwid_Best_Sellers_Messages::clear_all();
		}
	}

	public static function deactivate()
	{
		// todo
	}

	public static function uninstall()
	{
		// todo
	}

	public static function check_ecwid_main_plugin()
	{
		if (!self::is_ecwid_main_plugin_active()) {
			Ecwid_Best_Sellers_Messages::add_error(
				sprintf(__('You should install and activate <a href="%s" target="_blank">Ecwid Shopping Cart</a> plugin', 'ecwid-best-sellers'), 'https://wordpress.org/plugins/ecwid-shopping-cart/')
			);
		} else {
			Ecwid_Best_Sellers_Messages::clear_all();
		}

		Ecwid_Best_Sellers_Messages::show_messages();
	}

	private static function is_ecwid_main_plugin_active()
	{
		return in_array(self::ECWID_MAIN_PLUGIN, get_option('active_plugins'));
	}
}