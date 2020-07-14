<?php

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'easy-store' ); ?></a>
	<?php
	    do_action( 'easy_store_before_page' );
	?>
<div id="page" class="site">
	<?php 
		$easy_store_top_header_option = get_theme_mod( 'easy_store_top_header_option', 'hide' );
		if( $easy_store_top_header_option == 'show' ) {
			
		    do_action( 'easy_store_top_header' );
		}
	?>

	<?php
			
	    do_action( 'easy_store_header' );
	?>

	<?php
			
	    do_action( 'easy_store_page_title' );
	?>

	<div id="content" class="site-content">
		<div class="mt-container">
			<?php
			    do_action( 'easy_store_before_content' );
			?>
