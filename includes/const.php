<?php

$pluginBasenameParts = explode('/', ECWID_BEST_SELLERS_PLUGIN_PATH);
define( 'ECWID_BEST_SELLERS_DIR', plugin_dir_path( __FILE__ ) );
define( 'ECWID_BEST_SELLERS_PLUGIN_BASENAME', reset($pluginBasenameParts) );