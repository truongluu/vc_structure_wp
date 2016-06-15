<?php
/**
 * Created by PhpStorm.
 * User: xuantruong
 * Date: 6/10/16
 * Time: 2:55 PM
 */

define( "THEME_URL", get_stylesheet_directory_uri() );
define( 'THEME_BASE', get_stylesheet_directory() );



function zs_after_setup_theme() {
    load_theme_textdomain( "transport-child", get_stylesheet_directory_uri() . '/languages' );
}
add_action( 'after_setup_theme', 'zs_after_setup_theme' );

include_once 'inc/zs-shortcodes.php';