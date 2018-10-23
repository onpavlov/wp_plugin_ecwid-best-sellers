<?php

namespace Ecwid\Best_Sellers;

/**
 * Class Api
 * @package Ecwid\Best_Sellers
 */
class Api
{
	const ECWID_OAUTH_URL = 'https://my.ecwid.com/api/oauth/';

    public function __construct()
    {
        if (!defined('ECWID_BS_API_SECRET') || !defined('ECWID_BS_API_CLIENT_ID')) {
            Error::getInstance()->addError(__('Empty client id or secret code of Ecwid API', 'ecwid-best-sellers'));
        }
    }

	/**
	 * @param string $redirectUrl
	 *
	 * @return string
	 */
    public function getLinkForOAuth($redirectUrl = '')
    {
    	if (empty($redirectUrl)) {
    		global $wp;
    		$redirectUrl = home_url($wp->request);
	    }

		return self::ECWID_OAUTH_URL . 'authorize?client_id=' . ECWID_BS_API_CLIENT_ID . '&redirect_uri='
		       . $redirectUrl . '&response_type=code&scope=read_catalog read_orders';
    }

	/**
	 * @param $code
	 *
	 * @return bool
	 */
    public function getToken($code)
    {
    	if (empty($code)) {
    		return false;
	    }

    	$result = Http_Helper::get(self::ECWID_OAUTH_URL . 'token', [
		    'client_id' => ECWID_BS_API_CLIENT_ID,
		    'client_secret' => ECWID_BS_API_SECRET,
		    'code' => $code,
		    'redirect_uri' => home_url() . $_SERVER['SCRIPT_NAME'],
		    'grant_type' => 'authorization_code'
	    ]);

    	if ($result['response']['code'] == 200 && !empty($result['body'])) {
    		$body = json_decode($result['body']);
		    update_option(ECWID_BS_PLUGIN_BASENAME . '_api_token', $body->access_token);
		    update_option(ECWID_BS_PLUGIN_BASENAME . '_store_id', $body->store_id);
		    update_option(ECWID_BS_PLUGIN_BASENAME . '_admin_email', $body->email);

		    return true;

	    }

	    if (!empty($result['body'])) {
		    $body = json_decode($result['body']);
		    Error::getInstance()->addError($body->error_description);
	    } else {
		    Error::getInstance()->addError(__('Undefined error', 'ecwid-best-sellers'));
	    }

    	return false;
    }
}