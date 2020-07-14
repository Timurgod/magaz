<?php

function easy_store_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'easy_store_infinite_scroll_render',
		'footer'    => 'page',
	) );

	add_theme_support( 'jetpack-responsive-videos' );

	add_theme_support( 'jetpack-content-options', array(
		'post-details'    => array(
			'stylesheet' => 'easy-store-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
		'featured-images' => array(
			'archive'    => true,
			'post'       => true,
			'page'       => true,
		),
	) );
}
add_action( 'after_setup_theme', 'easy_store_jetpack_setup' );

function easy_store_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}
