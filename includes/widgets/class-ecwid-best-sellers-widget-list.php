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

    private $api;

	public function __construct() {
        $widget_ops = [
            'classname' => 'widget_ecwid_bs_list',
            'description' => __("Displays a list of best seller products from Ecwid shop", 'ecwid-best-sellers')
        ];
        $this->api = new Api();

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

            $this->api->getOrders();

            $product = new Product();
            $product->setId(123);
            $product->setName('Kinder Surprise');
            $product->setLink('http://kinder.com');
            $product->setPicture('https://www.mensjournal.com/wp-content/uploads/mf/1_loreal.jpg?w=800');
            $product->setPrice(99.99);
            $products = [$product];

            Template::renderTemplate('products_list', ['products' => $products, 'has_access' => $this->api->hasAccess()]);
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
	    if (Error::getInstance()->hasErrors()) {
		    Error::getInstance()->showErrors();
	    }

        $default_args = [];
        foreach ($this->getFormFields() as $field) {
            $default_args[$field['name']] = $field['default'];
        }

        $instance = wp_parse_args((array) $instance, $default_args);

        printf('<div class="%s">', $this->widget_options['classname']);

        foreach ($this->getFormFields() as $field) {
        	$fieldName = $this->get_field_name($field['name']);
        	$fieldTitle = $field['title'];
        	$fieldId = $this->get_field_id($field['name']);
        	$style = 'width:100%';

            if ($field['type'] == 'int') {
                Template::getTextFieldHtml($fieldName, $fieldTitle, $fieldId, intval($instance[$field['name']]), $style);
            } elseif ($field['type'] == 'list') {
                Template::getSelectFieldHtml($fieldName, $fieldTitle, $fieldId, range(1, $field['max']), $instance[$field['name']], $style);
            } else {
	            Template::getTextFieldHtml($fieldName, $fieldTitle, $fieldId, htmlspecialchars($instance[$field['name']], ENT_COMPAT, 'utf-8'), $style);
            }
        }
        print('</div>');

	    if (!$this->api->hasAccess()) {
            $popupBody = '<p><b>' . __('You should provide access to your Ecwid shop for using widget', 'ecwid-best-sellers') . '</b></p>';
            $popupBody .= '<p style="text-align: center"><a href="' . $this->api->getOAuthLink( home_url() . $_SERVER['SCRIPT_NAME'])
                                . '" class="button button-primary" style="margin-bottom: 20px">'
                                . __('Provide access', 'ecwid-best-sellers') . '</a></p>';

            printf('<script type="text/javascript">PopupEcwidBs.init(\'%s\', \'%s\')</script>', $popupBody, $this->widget_options['classname']);
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
}