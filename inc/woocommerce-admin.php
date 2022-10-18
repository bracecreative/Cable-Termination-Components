<?php

class Brace_WC_Admin{
    private static $instance = null;

    public static function i(){
        if (self::$instance == null){
            self::$instance = new Brace_WC_Admin();
        }
    
        return self::$instance;
    }

    public function __construct(){
        if(!is_admin()){
            return;
        }

        /**
         * Display fields for simple products
         */
        add_action('woocommerce_product_options_general_product_data', array($this, 'simple_settings_fields'));

        /**
         * Display fields for product variations
         */
        add_action('woocommerce_variation_options_pricing', array($this, 'variation_settings_fields'), 10, 3);
        
        /**
         * Update meta field values for simple
         * products
         */
        add_action('woocommerce_process_product_meta', array($this, 'save_simple_settings_fields'));

        /**
         * Update meta field values for product
         * variations
         */
        add_action('woocommerce_save_product_variation', array($this, 'save_variation_settings_fields'), 10, 2);
    }

    public function simple_settings_fields(){
        $fields = apply_filters('brace_woocommerce_meta_fields', array());

        if(empty($fields)){
            return;
        }

        echo '<div class="options_group show_if_simple show_if_variable">';
        foreach($fields as $field){

            // if($field['display'] !== 'simple'){
            //     continue;
            // }

            $type = isset($field['type']) ? $field['type'] : '';

            if($type === 'select'){
                woocommerce_wp_select(
                    array(
                        'id'            => "{$field['name']}",
                        'name'          => "{$field['name']}",
                        'label'         => __($field['label'], 'woocommerce'),
                        'desc_tip'      => isset($field['desc_tip']) ? (bool) $field['desc_tip'] : false,
                        'description'   => isset($field['description']) ? __($field['description'], 'woocommerce') : '',
                        'wrapper_class' => '',
                        'options'       => isset($field['options']) ? $field['options'] : array()
                    )
                );
            } else {
                woocommerce_wp_text_input(
                    array(
                        'id'            => "{$field['name']}",
                        'name'          => "{$field['name']}",
                        'label'         => __($field['label'], 'woocommerce'),
                        'desc_tip'      => isset($field['desc_tip']) ? (bool) $field['desc_tip'] : false,
                        'description'   => isset($field['description']) ? __($field['description'], 'woocommerce') : '',
                        'wrapper_class' => '',
                    )
                );
            }
        }
        echo '</div>';
    }

    public function variation_settings_fields($loop, $variation_data, $variation){
        $fields = apply_filters('brace_woocommerce_meta_fields', array());

        if(empty($fields)){
            return;
        }

        foreach ($fields as $field) {
            
            if($field['display'] !== 'variation'){
                continue;
            }

            $type = isset($field['type']) ? $field['type'] : '';

            if($type === 'select'){
                woocommerce_wp_select(
                    array(
                        'id'            => "{$field['name']}",
                        'name'          => "{$field['name']}",
                        'label'         => __($field['label'], 'woocommerce'),
                        'desc_tip'      => isset($field['desc_tip']) ? (bool) $field['desc_tip'] : false,
                        'description'   => isset($field['description']) ? __($field['description'], 'woocommerce') : '',
                        'wrapper_class' => '',
                        'options'       => isset($field['options']) ? $field['options'] : array()
                    )
                );
            } else {
                woocommerce_wp_text_input(
                    array(
                        'id'            => "{$field['name']}{$loop}",
                        'name'          => "{$field['name']}[{$loop}]",
                        'value'         => get_post_meta($variation->ID, $field['name'], true),
                        'label'         => __($field['label'], 'woocommerce'),
                        'desc_tip'      => isset($field['desc_tip']) ? (bool) $field['desc_tip'] : false,
                        'description'   => isset($field['description']) ? __($field['description'], 'woocommerce') : '',
                        'wrapper_class' => $field['class'],
                    )
                );
            }
        }
    }

    public function save_simple_settings_fields($post_id){
        $fields = apply_filters('brace_woocommerce_meta_fields', array());

        if(empty($fields)){
            return;
        }

        foreach($fields as $field){
            if(!isset($_POST[$field['name']])){
                continue;
            }

            if($field['display'] !== 'simple'){
                continue;
            }

            $value = stripslashes_deep($_POST[$field['name']]);

            if(!empty($field['as'])){
                $value = apply_filters('brace_woocommerce_format_meta_value', $value, $field['as']);
            }

            update_post_meta($post_id, $field['name'], $value);
        }
    }

    public function save_variation_settings_fields($variation_id, $loop){
        $fields = apply_filters('brace_woocommerce_meta_fields', array());

        if(empty($fields)){
            return;
        }

        foreach($fields as $field){
            if(!isset($_POST[$field['name']][$loop])){
                continue;
            }

            if($field['display'] !== 'variation'){
                continue;
            }

            $value = stripslashes_deep($_POST[$field['name']][$loop]);

            if(!empty($field['as'])){
                $value = apply_filters('brace_woocommerce_format_meta_value', $value, $field['as']);
            }

            update_post_meta($variation_id, $field['name'], $value);
        }
    }
}

Brace_WC_Admin::i();