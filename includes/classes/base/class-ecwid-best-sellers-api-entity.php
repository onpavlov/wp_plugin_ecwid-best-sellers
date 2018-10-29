<?php

namespace Ecwid\Best_Sellers;

/**
 * Class Base_Product
 */
abstract class Api_Entity
{
	protected $api;

	public function __construct(Api $api = null) {
		$this->api = $api;
	}

	/**
	 * @param array $params
	 *
	 * @return array|mixed|null|object
	 */
	public function find($params = [])
	{
		return $this->api->getList(static::ENTITY_CODE, $params);
	}

	abstract function getById($id);
}