<?php
/*
Plugin Name: Best Sellers for Ecwid
Description: Additional plugin for Ecwid. Shows best sellers products.
Text Domain: ecwid-best-sellers
Author: Oleg Pavlov
Version: 1.0.0
Author URI: https://vk.com/nameless4you
*/

use Ecwid\Best_Sellers\Plugin;

load_plugin_textdomain( 'ecwid-best-sellers', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

define('ECWID_BS_VERSION', '1.0.0');
define('ECWID_BS_PLUGIN_PATH', plugin_basename(__FILE__));

require_once 'includes/const.php';
require_once 'includes/autoload.php';

register_activation_hook(__FILE__, [Plugin::class, 'activate']);
register_deactivation_hook(__FILE__, [Plugin::class, 'deactivate']);
register_uninstall_hook(__FILE__, [Plugin::class, 'uninstall']);

Plugin::init();