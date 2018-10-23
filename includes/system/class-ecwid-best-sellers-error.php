<?php

namespace Ecwid\Best_Sellers;

class Error
{
    const ERROR_CODE = 'error_bs_plugin';

    private static $instance = null;
    private $wpError;

    private function __construct() {
        $this->wpError = new \WP_Error();
    }

    /**
     * @return Error|null
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function addError($message)
    {
        $this->wpError->add(self::ERROR_CODE, '<p style="color: red"><b>' . __('Error: ', 'ecwid-best-sellers') . '</b>' . $message . '</p>');
    }

    public function hasErrors()
    {
        return !empty($this->wpError->errors);
    }

    public function getMessages()
    {
        return $this->wpError->get_error_messages(self::ERROR_CODE);
    }

    public function showErrors()
    {
        if($errors = $this->getMessages()) {
            foreach ($errors as $error) {
                echo $error;
            }
        }
    }
}