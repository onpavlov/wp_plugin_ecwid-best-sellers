<?php

namespace Ecwid\Best_Sellers;

/**
 * Class Base_Product
 * @package Ecwid\Best_Sellers
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string $picture
 * @property float $price
 */
class Product extends Api_Entity
{
    private $id;
    private $name;
    private $link;
    private $picture;
    private $price;

	const ENTITY_CODE = 'products';
	const OFFSET = 100;

	public function __get($name)
    {
        if (isset($this->{$name})) {
            return $this->{$name};
        }

        return false;
    }

	public function getById($id) {
		$result = $this->find(['productId' => $id])->items;
		return empty($result) ? [] : $result;
	}

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        if (!is_numeric($id)) {
            throw new \UnexpectedValueException('Param id isn\'t numeric');
        }

        $this->id = (int) $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = esc_html($name);
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = esc_html($link);
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = esc_html($picture);
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        if (!is_float($price) && !is_numeric($price)) {
            throw new \UnexpectedValueException('Param price isn\'t numeric');
        }
        $this->price = $price;
    }
}