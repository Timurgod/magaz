<?php

$default_sidebar = apply_filters( 'easy_store_filter_left_sidebar_id', 'left_sidebar', 'left' );
?>

<div id="secondary" class="widget-area sidebar" role="complementary">
	<?php if ( is_active_sidebar( $default_sidebar ) ) : ?>
		<?php dynamic_sidebar( $default_sidebar ); ?>
	<?php else : ?>
		<?php
			do_action( 'easy_store_action_left_sidebar', $default_sidebar, 'left' );
		?>
	<?php endif; ?>
</div><!-- #secondary -->