<?php

namespace Ecwid\Best_Sellers;

class Api
{
    public function __construct()
    {
        if (!defined('ECWID_BS_API_SECRET') || !defined('ECWID_BS_API_CLIENT_ID')) {
            Error::getInstance()->addError(__('Empty client id or secret code of Ecwid API', 'ecwid-best-sellers'));
        }
    }
}