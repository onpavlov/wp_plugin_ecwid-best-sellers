<?php

namespace Ecwid\Best_Sellers;

/**
 * Class Orders
 * @package Ecwid\Best_Sellers
 *
 * @property int $id
 * @property int $order_id
 * @property int $total
 * @property string $email
 * @property int $create_timestamp
 * @property int $update_timestamp
 */
class Orders extends Api_Entity
{
	const ENTITY_CODE = 'orders';
	const OFFSET = 100;

	public function getById($id) {
		$result = $this->find(['orderNumber' => $id])->items;
		return empty($result) ? [] : $result;
	}

	/**
	 * @return array
	 */
	public function getLastMonthOrders()
	{
		$month = 31*24*60*60; // Last month
		$updFrom = time() - $month;
		$offset = 0;
		$result = [];

		while ($response = $this->find(['updatedFrom' => $updFrom, 'offset' => $offset])->items) {
			$result = array_merge($result, $response);
			$offset += self::OFFSET;
		}

		return $result;
	}
}