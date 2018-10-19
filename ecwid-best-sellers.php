<?php
/*
Plugin Name: Ecwid Best sellers
Description: Additional plugin for Ecwid. Shows best sellers products.
Text Domain: ecwid-best-sellers
Author: Oleg Pavlov
Version: 1.0.0
Author URI: https://vk.com/nameless4you
*/

define('ECWID_BEST_SELLERS_VERSION', '1.0.0');
define('ECWID_BEST_SELLERS_PLUGIN_PATH', plugin_basename(__FILE__));

require_once 'includes/const.php';
require_once 'includes/autoload.php';

register_activation_hook(__FILE__, ['Ecwid_Best_Sellers_Plugin', 'activate']);
register_deactivation_hook(__FILE__, ['Ecwid_Best_Sellers_Plugin', 'deactivate']);
register_uninstall_hook(__FILE__, ['Ecwid_Best_Sellers_Plugin', 'uninstall']);