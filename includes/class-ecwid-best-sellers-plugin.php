<?php

class Ecwid_Best_Sellers_Plugin
{
	const ECWID_MAIN_PLUGIN = 'ecwid-shopping-cart/ecwid-shopping-cart.php';

	public static function activate()
	{
		if (!in_array(self::ECWID_MAIN_PLUGIN, get_option('active_plugins'))) {
			$html = '<a href="' . wp_get_referer() . '"><-- Back</a><br><br>';
			$html .= '<p style="text-align: center">You should install and activate <a href="https://wordpress.org/plugins/ecwid-shopping-cart/" target="_blank">Ecwid Shopping Cart</a> plugin</p>';
			WP_die($html);
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
}