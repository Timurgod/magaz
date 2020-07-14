<?php

get_header(); ?>

<?php
	if( is_front_page() ) {
		$easy_store_homepage_content_status = get_theme_mod( 'easy_store_homepage_content_status', true );
	} else {
		$easy_store_homepage_content_status = apply_filters( 'easy_store_filter_index_content', true );
	}
	if ( true === $easy_store_homepage_content_status ) {
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
		do_action( 'easy_store_sidebar' );
	?>

<?php } // End if show home content. ?>

<?php
get_footer();
