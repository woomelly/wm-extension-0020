<?php
/*
 * Plugin Name: Woomelly Extension 020 Add ons 
 * Version: 1.1.1
 * Plugin URI: https://github.com/woomelly/wm-extension-0020/
 * Description: Woomelly extension that allows replicating base price and discount price from Mercado Libre to WooCommerce
 * Author: Team Woomelly
 * Author URI: https://woomelly.com/
 * Requires at least: 4.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'wm_filter_convert_price_ext_020' ) ) {
	add_action( 'wm_filter_convert_price', 'wm_filter_convert_price_ext_020', 10, 2 );
	function wm_filter_convert_price_ext_020( $wm_import_price, $data_item ) {        
        if ( $data_item->original_price != null && intval($data_item->original_price) > 1 ) {
            $wm_import_price = wc_format_decimal( $data_item->original_price, wc_get_price_decimals() );
        }
        return $wm_import_price;
	}
}

if ( ! function_exists( 'wm_filter_sales_price_ext_020' ) ) {
    add_action( 'wm_filter_sales_price', 'wm_filter_sales_price_ext_020', 10, 5 );
    function wm_filter_sales_price_ext_020( $pprice, $wm_import_price_original, $wm_import_price, $data_item, $wm_product = null ) {        
        if ( $data_item->original_price != null && intval($data_item->original_price) > 1 ) {
            $pprice = wc_format_decimal( $data_item->price, wc_get_price_decimals() );
        } else {
            $pprice = (-1);
        }
        return $pprice;
    }
}

?>