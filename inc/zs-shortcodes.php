<?php
/**
 * Created by PhpStorm.
 * User: xuantruong
 * Date: 6/13/16
 * Time: 4:10 PM
 */
// Load all vc maps
$vc_maps_dir = dirname( __FILE__ ) . '/vc_maps/';
$vc_files = glob( $vc_maps_dir . '*', GLOB_ONLYDIR );
if( $vc_files ) {

    foreach ( $vc_files as $vc_module ) {
        foreach( glob( $vc_module . '/*' ) as $file )
            file_exists( $file ) and include_once $file;
    }
}