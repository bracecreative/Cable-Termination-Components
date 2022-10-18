<?php

/**
 * Adds some custom WooCommerce fields
 * 
 */
add_filter('brace_woocommerce_meta_fields', 'brace_custom_woocommerce_meta_fields');
function brace_custom_woocommerce_meta_fields($fields){
    $fields['unit_quantity'] = array(
        'name'        => 'unit_quantity',
        'label'       => 'Unit Quantity',
        'desc_tip'    => true,
        'description' => 'Displayed along side the product on the front-end - has no effect on price.',
        'class'       => 'form-row form-row-first',
        'as'          => 'int',
        'display'     => 'variation'
    );

    $tableOptions = wp_list_pluck(get_posts(array('post_type' => 'tablepress_table', 'post_status' => 'publish', 'posts_per_page' => -1)), 'post_title', 'ID');
    $tableOptions = array('' => 'No Table Selected') + $tableOptions;
    
    $fields['display_table'] = array(
        'name'        => 'display_table',
        'label'       => 'Display Table',
        'desc_tip'    => true,
        'description' => 'Displayed along side the product on the front-end.',
        'class'       => 'form-row form-row-first',
        'as'          => 'int',
        'type'        => 'select',
        'options'     => $tableOptions,
        'display'     => 'simple'
    );

    return $fields;
}

/**
 * How to sanitize meta fields, if
 * necessary
 */
add_filter('brace_woocommerce_format_meta_value', 'brace_custom_woocommerce_meta_formatting', 10, 2);
function brace_custom_woocommerce_meta_formatting($value, $as){
    switch($as){
        case 'int': {
            $value = absint($value);
            break;
        }
    }

    return $value;
}