<?php
/*
Plugin Name: Ultimate Product Gallery for WooCommerce
Version: 1.0.1
Description: WooCommerce Product Gallery Plugin
Plugin URI: http://barfaraz.com/plugin/ultimate-product-gallery-for-woocommerce/
Author: Barfaraz
Author URI: http://www.barfaraz.com
Requires at least: 4.3.10
Tested up to: 5.2
WC requires at least: 3.0.0
WC tested up to: 3.6.2
*/

if ( ! function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit();
}

if( ! defined( 'UPGFW_DIR_PATH' ) ) {
	define( 'UPGFW_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

if( ! defined( 'UPGFW_URL_PATH' ) ) {
	define( 'UPGFW_URL_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
}

if( ! defined( 'UPGFW_BASENAME' ) ) {
	define( 'UPGFW_BASENAME', plugin_basename( __FILE__ ) );
}

require_once( UPGFW_DIR_PATH . 'classes/upgfw.php' );

$UPGFW = new UPGFW();

/* options */

require_once 'vafpress-framework/bootstrap.php';

$tmpl_opt  = plugin_dir_path( __FILE__ ) . '/admin/option/option.php';

$plugin_options = new VP_Option(array(
	'is_dev_mode'           => false,
	'option_key'            => 'upgfw_option',
	'page_slug'             => 'upgfw_option',
	'template'              => $tmpl_opt,
	'menu_page'             =>  array(),
	'use_auto_group_naming' => true,
	'use_util_menu'         => true,
	'minimum_role'          => 'edit_theme_options',
	'layout'                => 'fluid',
	'page_title'            => __( 'Ultimate Product Gallery for WooCommerce', 'upgfw' ),
	'menu_label'            => __( 'Ultimate Product Gallery', 'upgfw' ),
));

?>