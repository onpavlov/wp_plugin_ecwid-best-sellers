<?php

namespace Ecwid\Best_Sellers;

class Cache
{
	const PREFIX = 'ecwid_bs_';

	static public function get($name, $default = false)
	{
		$result = get_transient(self::PREFIX . $name);

		if ($default !== false && $result === false) {
			return $default;
		}

		return $result;
	}

	static public function set($name, $value, $expires_after)
	{
		set_transient(self::PREFIX . $name, $value, $expires_after);
	}

	static public function reset($name) {
		delete_transient(self::PREFIX . $name);
	}
}