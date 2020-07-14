<?php

get_header(); ?>

<?php
	if( is_front_page() ) {
		$easy_store_homepage_content_status = get_theme_mod( 'easy_store_homepage_content_status', true );
	} else {
		$easy_store_homepage_content_status = apply_filters( 'easy_store_filter_page_content', true );
	}
	if ( true === $easy_store_homepage_content_status ) {
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
		do_action( 'easy_store_sidebar' );
	?>

<?php } // End if show home content. ?>

<?php
get_footer();
