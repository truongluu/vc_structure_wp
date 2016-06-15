<?php
/**
 * Created by PhpStorm.
 * User: xuantruong
 * Date: 6/14/16
 * Time: 2:56 PM
 */
// Template vc

add_action( 'vc_before_init', 'zs_vc_recent_news_func' );
// Generate param type "number"
if ( function_exists('add_shortcode_param') )
{
    add_shortcode_param( 'number', 'sc_number_field' );
}

if( function_exists( 'vc_add_shortcode_param' ) ) {
    vc_add_shortcode_param( 'chk_post_categories', 'chk_post_categories_params_func', THEME_URL . '/js/vc_maps.js' );

}

function chk_post_categories_params_func( $settings, $value ) {
    if ( is_array( $value ) ) {
        $value = ''; // fix #1239
    }
    $value_arr = strlen( $value ) > 0 ? explode( ',', $value ) : array();
    $type = isset( $settings['type'] ) ? $settings['type'] : '';
    $checked = in_array( 0 , $value_arr );
    $output = '<div class="edit_form_line">';
    $output .= '<label class="vc_checkbox-label">
        <input id="' . esc_attr( $settings['param_name'] ) . '-0" value="0" class="wpb_vc_param_value ' . esc_attr( $settings['param_name'] ) . ' ' . $type . '" type="checkbox" name="' . esc_attr( $settings['param_name'] ) . '" ' . $checked . '>
        All
    </label>';
    $post_categories = get_categories();
    foreach ( $post_categories as $category ) {
        $checked = count( $value_arr ) > 0 && in_array( $category->cat_ID, $value_arr ) ? ' checked' : '';
        $output .= ' <label class="vc_checkbox-label"><input id="'
            . $settings['param_name'] . '-' . $category->cat_ID . '" value="'
            . $category->cat_ID . '" class="wpb_vc_param_value '
            . $settings['param_name'] . ' ' . $settings['type'] . '" type="checkbox" name="'
            . $settings['param_name'] . '"'
            . $checked . '> ' . $category->name . '</label>';
    }
    $output .= '</div>';
    return $output;
}

// Function generate param type "number"
function sc_number_field($settings, $value)
{
    $dependency = vc_generate_dependencies_attributes($settings);
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $min = isset($settings['min']) ? $settings['min'] : '';
    $max = isset($settings['max']) ? $settings['max'] : '';
    $suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';
    $output .= '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" />'.$suffix;
    return $output;
}

// Generate param type "custom_size"
if ( function_exists('add_shortcode_param'))
{
    add_shortcode_param( 'custom_size', 'sc_custom_size' );
}

function sc_custom_size( $settings, $value ) {
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';
    $added_sizes = get_intermediate_image_sizes();
    $output .= '<select id="thumb" name="'.$param_name.'" class="wpb_vc_param_value '.$param_name.' '.$type.' '.$class.'">';
    foreach($added_sizes as $key => $sc_value){
        if($value == $sc_value){
            $selected = "selected='selected'";
        } else {
            $selected = '';
        }
        $output .= '<option '.$selected.' value="'. $sc_value .'">'. $sc_value .'</option>';
    }
    $output .= '</select>' ;
    return $output;
}


if ( function_exists('add_shortcode_param'))
{
    add_shortcode_param( 'my_text', 'my_text_func' );
}

function my_text_func( $settings, $value ) {
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';
    $output = '<input id="mytext" type="text" name="'.$param_name.'" value="' . $value . '" class="wpb_vc_param_value '.$param_name.' '.$type.' '.$class.'" />';
    return $output;
}

function zs_vc_recent_news_func() {

    vc_map( array(
        'name' => __( 'Recent News', 'showcase-visual-composer-addon' ),
        'base' => 'zs_recent_news',
        "description" => __( "Shortcode for Recent News" ),
        "icon" => "icon-rn-vc-addon",
        'admin_enqueue_css' => array( THEME_URL . '/css/vc_maps.css' ),
        'front_enqueue_css' => array( THEME_URL . '/css/vc_maps.css' ),
        'admin_enqueue_js' => array( THEME_URL . '/js/vc_maps.js' ),
        'front_enqueue_js' => array( THEME_URL . '/js/vc_maps.js' ),
        'params'=>array(
            array(
                "param_name" => "info_title_separator",
                "heading" => __( 'Configure Title Style' ),
                'group' => __( 'General Settings' )
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Box Title"),
                "param_name" => "rn_title",
                "value" => 'Recent News',
                'save_always' => true,
                "description" => __( "Default is Recent News" ),
                'group' => __( 'General Settings' )
            ),
            array(
                "type" => "chk_post_categories",
                "class" => "rn_categories",
                "heading" => __( "Choose Categories" ),
                "param_name" => "rn_categories",
                "value" => '',
                'save_always' => true,
                "group" => __( 'General Settings' ),
                "description" => __( "Category Default is All" ),
            ),
            array(
                "type" => "number",
                "class" => "",
                "heading" => __("Number Post"),
                "param_name" => "rn_num_post",
                'min' => 0,
                "value" => 2,
                'save_always' => true,
                "description" => __( "Default is Recent News" ),
                'group' => __( 'General Settings' )
            ),
        ),
        'category' => __( get_bloginfo( 'name' ) .' - Shortcodes' ),
    ) );

}