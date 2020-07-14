<?php

if ( ! function_exists( 'easy_store_setup' ) ) :
	function easy_store_setup() {
		load_theme_textdomain( 'easy-store', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'easy-store-slider', 840, 500 );
		add_image_size( 'easy-store-blog-thumb', 600, 300 );


		
		register_nav_menus( array(
			'easy_store_top_menu' 	  => esc_html__( 'Top Menu', 'easy-store' ),
			'easy_store_primary_menu' => esc_html__( 'Primary Menu', 'easy-store' ),
			'easy_store_footer_menu'  => esc_html__( 'Footer Menu', 'easy-store' )
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'easy_store_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 320,
			'width'       => 75,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'easy_store_setup' );

function easy_store_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'easy_store_content_width', 640 );
}
add_action( 'after_setup_theme', 'easy_store_content_width', 0 );

function easy_store_theme_version() {
    $easy_store_theme_info = wp_get_theme();
    $GLOBALS['easy_store_version'] = $easy_store_theme_info->get( 'Version' );
}
add_action( 'after_setup_theme', 'easy_store_theme_version', 0 );

require get_template_directory() . '/inc/custom-header.php';

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/customizer/customizer.php';

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

require get_template_directory() . '/inc/hooks/es-header-hooks.php';
require get_template_directory() . '/inc/hooks/es-footer-hooks.php';
require get_template_directory() . '/inc/hooks/es-custom-hooks.php';

require get_template_directory() . '/inc/es-post-sidebar-meta.php';

require get_template_directory() . '/inc/widgets/es-widget-functions.php';

require get_template_directory() . '/inc/tgm/es-required-plugins.php';

require get_template_directory() . '/inc/theme-settings/mt-theme-settings.php';