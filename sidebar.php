<?php

$default_sidebar = apply_filters( 'easy_store_filter_default_sidebar_id', 'sidebar-1', 'primary' );
?>

<div id="secondary" class="widget-area sidebar" role="complementary">
	<?php if ( is_active_sidebar( $default_sidebar ) ) : ?>
		<?php dynamic_sidebar( $default_sidebar ); ?>
	<?php else : ?>
		<?php
			do_action( 'easy_store_action_default_sidebar', $default_sidebar, 'primary' );
		?>
	<?php endif; ?>
</div><!-- #secondary -->