<?php
/*
Plugin Name: Best Sellers for Ecwid
Description: Additional plugin for Ecwid. Shows best sellers products.
Text Domain: ecwid-best-sellers
Author: Oleg Pavlov
Version: 1.0.0
Author URI: https://vk.com/nameless4you
*/
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
use Ecwid\Best_Sellers\Plugin;

load_plugin_textdomain( 'ecwid-best-sellers', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

define('ECWID_BS_VERSION', '1.0.0');
define('ECWID_BS_PLUGIN_PATH', plugin_basename(__FILE__));
define('ECWID_BS_PLUGIN_URL', plugin_dir_url(__FILE__));

update_option('ecwid_bs_plugin_version', ECWID_BS_VERSION);

require_once 'includes/const.php';
require_once 'includes/autoload.php';
require_once 'includes/assets.php';

register_activation_hook(__FILE__, [Plugin::class, 'activate']);
register_deactivation_hook(__FILE__, [Plugin::class, 'deactivate']);
register_uninstall_hook(__FILE__, [Plugin::class, 'uninstall']);

Plugin::init();