<?php

if ( ! function_exists( 'easy_store_sanitize_checkbox' ) ) :

    function easy_store_sanitize_checkbox( $checked ) {

        return ( ( isset( $checked ) && true === $checked ) ? true : false );

    }

endif;

if ( ! function_exists( 'easy_store_sanitize_select' ) ) :

    function easy_store_sanitize_select( $input, $setting ) {

        $input = sanitize_key( $input );

        $choices = $setting->manager->get_control( $setting->id )->choices;

        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

    }

endif;

if ( ! function_exists( 'easy_store_sanitize_image' ) ) :

    function easy_store_sanitize_image( $image, $setting ) {

        $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon',
        );

        $file = wp_check_filetype( $image, $mimes );

        return ( $file['ext'] ? $image : $setting->default );

    }

endif;

function easy_store_sanitize_switch_option( $input ) {
    $valid_keys = array(
            'show'  => __( 'Show', 'easy-store' ),
            'hide'  => __( 'Hide', 'easy-store' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

function easy_store_sanitize_repeater( $input, $setting ){
    $input_decoded = json_decode( $input, true );
    $default_decoded = json_decode( $setting->default, true );

    $easy_store_icon_array          = array_flip( easy_store_font_awesome_icon_array() );
    $easy_store_social_icon_array   = array_flip( easy_store_font_awesome_social_icon_array() );
        
    if( !empty( $input_decoded ) ) {

        foreach ( $input_decoded as $boxes => $box ){
            foreach ( $box as $key => $value ){

                if( $key == 'mt_item_url' || $key == 'mt_item_upload' ) {
                    $input_decoded[$boxes][$key] = esc_url_raw( $value );
                } elseif( $key == 'mt_item_icon' ) {
                    $default = $default_decoded[ 0 ][ 'mt_item_icon' ];
                    $input_decoded[ $boxes ][ $key ] = array_key_exists( $value, $easy_store_icon_array ) ? $value : $default;
                } elseif( $key == 'mt_item_social_icon' ) {
                    $default = $default_decoded[ 0 ][ 'mt_item_social_icon' ];
                    $input_decoded[ $boxes ][ $key ] = array_key_exists( $value, $easy_store_social_icon_array ) ? $value : $default;
                } else {
                    $input_decoded[$boxes][$key] = wp_kses_post( $value );
                }
            }
        }
        return json_encode( $input_decoded );
    }
    
    return $input;
}