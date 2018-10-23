<?php

namespace Ecwid\Best_Sellers;

/**
 * Class Widget_List
 * @package Ecwid\Best_Sellers
 */
class Widget_List extends \WP_Widget
{
    const LIST_MIN_COUNT = 1;
    const LIST_MAX_COUNT = 5;
    const LIST_DEFAULT_COUNT = 3;

	public function __construct() {
        $widget_ops = [
            'classname' => 'widget_ecwid_best_sellers_list',
            'description' => __("Displays a list of best seller products from Ecwid shop", 'ecwid-best-sellers')
        ];
        parent::__construct('ecwid_bs_list', __('Best Sellers for Ecwid', 'ecwid-best-sellers'), $widget_ops);
	}

    /**
     * Front-end display of widget
     *
     * @param array $args
     * @param array $instance
     */
	public function widget($args, $instance)
    {
        if (Error::getInstance()->hasErrors()) {
            Error::getInstance()->showErrors();
        } else {
            $before_widget = $before_title = $after_title = $after_widget = '';
            extract($args);
            $title = empty($instance['title']) ? '' : $instance['title'];
            $title = apply_filters('widget_title', $title);

            if ($title) {
                echo $before_title . $title . $after_title;
            }

            $product = new Product();
            $product->setId(123);
            $product->setName('Kinder Surprise');
            $product->setLink('http://kinder.com');
            $product->setPicture('https://www.mensjournal.com/wp-content/uploads/mf/1_loreal.jpg?w=800');
            $product->setPrice(99.99);
            $products = [$product];

            $this->renderTemplate('products_list', ['products' => $products]);
        }
    }

    /**
     * Settings form for widget
     *
     * @param array $instance
     * @return string|void
     */
    public function form($instance)
    {
        $default_args = [];
        foreach ($this->getFormFields() as $field) {
            $default_args[$field['name']] = $field['default'];
        }

        $instance = wp_parse_args((array) $instance, $default_args);

        foreach ($this->getFormFields() as $field) {
            $template = '<p><label for="%s">%s:<input style="%s" id="%s" name="%s" type="text" value="%s" /></label></p>';

            if ($field['type'] == 'int') {
                $value = intval($instance[$field['name']]);
            } elseif ($field['type'] == 'list') {
                $value = '';
                $template = '<p><label for="%s">%s:<select style="%s" id="%s" name="%s">%s';

                for ($val = 1;$val <= $field['max']; $val++) {
                    $value .= '<option value="' . $val . '" ' . ($instance[$field['name']] == $val ? 'selected' : '') . ' >' . $val . '</option>';
                }

                $template .= '</select></label></p>';
            } else {
                $value = htmlspecialchars($instance[$field['name']]);
            }

            printf(
                $template,
                $this->get_field_name($field['name']),
                $field['title'],
                'width:100%',
                $this->get_field_id($field['name']),
                $this->get_field_name($field['name']),
                $value
            );
        }
    }

    /**
     * Validate settings before save
     *
     * @param array $new_instance
     * @param array $instance
     * @return array
     */
    public function update($new_instance, $instance)
    {
        foreach ($this->getFormFields() as $field) {
            switch ($field['type']) {
                case 'int':
                    $instance[$field['name']] = intval($new_instance[$field['name']]);
                    break;
                case 'list':
                    $num = intval($new_instance[$field['name']]);
                    if ($num > self::LIST_MAX_COUNT) {
                        $num = self::LIST_MAX_COUNT;
                    } elseif ($num < self::LIST_MIN_COUNT) {
                        $num = self::LIST_DEFAULT_COUNT;
                    }
                    $instance[$field['name']] = $num;
                    break;
                default:
                    $instance[$field['name']] = strip_tags(stripslashes($new_instance[$field['name']]));
            }
        }

        return $instance;
    }

    private function getFormFields()
    {
        return [
            [
                'name' => 'title',
                'title' => __('Title'),
                'type' => 'text',
                'default' => __('Best Sellers for Ecwid', 'ecwid-best-sellers'),
            ],
            [
                'name' => 'number_of_products',
                'title' => __('Number of products to show', 'ecwid-best-sellers'),
                'type' => 'list',
                'default' => self::LIST_DEFAULT_COUNT,
                'max' => self::LIST_MAX_COUNT
            ]
        ];
    }

    private function renderTemplate($template, $variables = [])
    {
        extract($variables);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/' . ECWID_BS_PLUGIN_BASENAME . '/templates/' . $template . '.php';
    }
}