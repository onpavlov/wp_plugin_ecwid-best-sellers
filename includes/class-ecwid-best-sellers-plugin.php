<?php

namespace Ecwid\Best_Sellers;

class Plugin
{
	const ECWID_MAIN_PLUGIN = 'ecwid-shopping-cart/ecwid-shopping-cart.php';

	public static function init()
    {
        self::init_ecwid();
        self::checkEcwidMainPlugin();
        self::init_widgets();
    }

	public static function activate()
	{
		if (!self::isEcwidMainPluginActive()) {
			WP_die(sprintf(__('<a href="%s"><-- Back</a><br><br><p style="text-align: center">You should install and activate <a href="%s" target="_blank">Ecwid Shopping Cart</a> plugin</p>', 'ecwid-best-sellers'), wp_get_referer(), 'https://wordpress.org/plugins/ecwid-shopping-cart/'));
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

	public static function checkEcwidMainPlugin()
	{
	    if (is_admin()) {
            Messages::clearAll();

            if (!self::isEcwidMainPluginActive()) {
                Messages::addError(
                    sprintf(__('<b>Best Sellers for Ecwid</b>: You should install and activate <a href="%s" target="_blank">Ecwid Shopping Cart</a> plugin', 'ecwid-best-sellers'), 'https://wordpress.org/plugins/ecwid-shopping-cart/')
                );
            }

            Messages::showMessages();
        }
	}

    /**
     * @return bool
     */
	private static function isEcwidMainPluginActive()
	{
		return in_array(self::ECWID_MAIN_PLUGIN, get_option('active_plugins'));
	}

	private static function init_ecwid()
    {
        // todo
    }

	private static function init_widgets()
    {
//        if (Ecwid_Api_V3::is_available()) {
        add_action('widgets_init', function() {
        	if (!empty($_GET['code'])) {
		        (new Api())->getToken(htmlspecialchars($_GET['code']));
	        }

            register_widget(Widget_List::class);
        });
//        }
    }
}