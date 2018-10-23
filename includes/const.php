<?php
$pluginBasenameParts = explode('/', ECWID_BS_PLUGIN_PATH);
define( 'ECWID_BS_DIR', plugin_dir_path( __FILE__ ) );
define( 'ECWID_BS_PLUGIN_BASENAME', reset($pluginBasenameParts) );

require_once 'config.php';