<?php

namespace Ecwid\Best_Sellers;

class Plugin {
	const ECWID_MAIN_PLUGIN = 'ecwid-shopping-cart/ecwid-shopping-cart.php';

	public static function init() {
		self::checkEcwidMainPlugin();
		self::initWidgets();
	}

	public static function activate() {
		if ( ! self::isEcwidMainPluginActive() ) {
			WP_die( sprintf( __( '<a href="%s"><-- Back</a><br><br><p style="text-align: center">You should install and activate <a href="%s" target="_blank">Ecwid Shopping Cart</a> plugin</p>', 'ecwid-best-sellers' ), wp_get_referer(), 'https://wordpress.org/plugins/ecwid-shopping-cart/' ) );
		}

//		self::installDbTables();
	}

	public static function deactivate() {
//		self::clearDbTables();
	}

	public static function uninstall() {
//		self::uninstallDbTables();
	}

	public static function checkEcwidMainPlugin() {
		if ( is_admin() ) {
			Messages::clearAll();

			if ( ! self::isEcwidMainPluginActive() ) {
				Messages::addError(
					sprintf( __( '<b>Best Sellers for Ecwid</b>: You should install and activate <a href="%s" target="_blank">Ecwid Shopping Cart</a> plugin', 'ecwid-best-sellers' ), 'https://wordpress.org/plugins/ecwid-shopping-cart/' )
				);
			}

			Messages::showMessages();
		}
	}

	/**
	 * @return bool
	 */
	private static function isEcwidMainPluginActive() {
		return in_array( self::ECWID_MAIN_PLUGIN, get_option( 'active_plugins' ) );
	}

	private static function initWidgets() {
		add_action( 'widgets_init', function () {
			if ( ! empty( $_GET['code'] ) ) {
				( new Api() )->getToken( htmlspecialchars( $_GET['code'], ENT_COMPAT, 'utf-8' ) );
			}

			register_widget( Widget_List::class );
		} );
	}

	private static function installDbTables() {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . Orders::TABLE_NAME;
		$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$sql = "CREATE TABLE {$table_name} (
					id int(11) unsigned NOT NULL auto_increment,
					order_id int(11) NOT NULL,
					total int(11) unsigned NOT NULL default '0',
					email varchar(50) NOT NULL,
					create_timestamp int(20) NOT NULL,
					update_timestamp int(20) NOT NULL,
					PRIMARY KEY  (id)
				) {$charset_collate};";

		dbDelta($sql);
	}

	private static function uninstallDbTables() {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . Orders::TABLE_NAME;
		$sql = "DROP TABLE IF EXISTS {$table_name}";
		$wpdb->query( $sql );

		delete_option( ECWID_BS_PLUGIN_BASENAME . '_api_token' );
		delete_option( ECWID_BS_PLUGIN_BASENAME . '_api_public_token' );
		delete_option( ECWID_BS_PLUGIN_BASENAME . '_store_id' );
		delete_option( ECWID_BS_PLUGIN_BASENAME . '_admin_email' );
	}

	private static function clearDbTables()
	{
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . Orders::TABLE_NAME;
		$sql = "TRUNCATE TABLE {$table_name}";
		$wpdb->query( $sql );
	}
}