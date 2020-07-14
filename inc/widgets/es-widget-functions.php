<?php

function easy_store_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'easy-store' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'easy-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'easy-store' ),
		'id'            => 'left_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'easy-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Header Area', 'easy-store' ),
		'id'            => 'header_area_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'easy-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Page Section', 'easy-store' ),
		'id'            => 'front_page_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'easy-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="es-block-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'easy-store' ),
		'id'            => 'easy_store_shop_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'easy-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebars( 4 , array(
		'name'          => esc_html__( 'Footer %d', 'easy-store' ),
		'id'            => 'easy_store_footer_sidebar',
		'description'   => esc_html__( 'Added widgets are display at Footer Widget Area.', 'easy-store' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	
}
add_action( 'widgets_init', 'easy_store_widgets_init' );

function easy_store_register_grid_layout_widget() {
    
    register_widget( 'Easy_Store_Slider' );

    register_widget( 'Easy_Store_Promo_Items' );

    register_widget( 'Easy_Store_Latest_Posts' );

    register_widget( 'Easy_Store_Testimonials' );

    register_widget( 'Easy_Store_Call_To_Action' );

    register_widget( 'Easy_Store_Advance_Product_Search' );

    register_widget( 'Easy_Store_Sponsors' );

    register_widget( 'Easy_Store_Social_Media' );

    if( is_woocommerce_activated() ) {
    	register_widget( 'Easy_Store_Featured_Products' );

    	register_widget( 'Easy_Store_Categories_Collection' );

    	register_widget( 'Easy_Store_Category_Products' );
    }
}

add_action( 'widgets_init', 'easy_store_register_grid_layout_widget' );

require get_template_directory() . '/inc/widgets/es-widget-fields.php';
require get_template_directory() . '/inc/widgets/es-slider.php';
require get_template_directory() . '/inc/widgets/es-promo-items.php';
require get_template_directory() . '/inc/widgets/es-latest-posts.php';
require get_template_directory() . '/inc/widgets/es-testimonials.php';
require get_template_directory() . '/inc/widgets/es-call-to-action.php';
require get_template_directory() . '/inc/widgets/es-advance-product-search.php';
require get_template_directory() . '/inc/widgets/es-sponsors.php';
require get_template_directory() . '/inc/widgets/es-social-media.php';


if( is_woocommerce_activated() ) {

	require get_template_directory() . '/inc/widgets/es-categories-collection.php';
	require get_template_directory() . '/inc/widgets/es-featured-products.php';
	require get_template_directory() . '/inc/widgets/es-category-products.php';

}