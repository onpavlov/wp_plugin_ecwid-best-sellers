<?php
/**
 * Autoloader for classes in current folder
 * searches and requires files named by pattern class-{plugin-name}-{class-name}.php
 */

$require_paths = [
	'/',
    '/system',
	'/widgets',
	'/helpers',
	'/classes/product',
	'/classes/orders',
	'/classes/base',
];

spl_autoload_register(function($class) use ($require_paths) {
	$file = 'class-' . str_replace(['\\', '_'], '-', strtolower($class)) . '.php';

	foreach ($require_paths as $path) {
		$require = __DIR__ . $path . '/' . $file;

		if (is_file($require) && (strpos($file, ECWID_BS_PLUGIN_BASENAME) !== false)) {
			require_once $require;
		}
	}
});