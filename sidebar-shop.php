<?php

$default_sidebar = apply_filters( 'easy_store_filter_shop_sidebar_id', 'easy_store_shop_sidebar', 'shop-sidebar' );
?>

<div id="sidebar-shop" class="widget-area sidebar" role="complementary">
	<?php if ( is_active_sidebar( $default_sidebar ) ) : ?>
		<?php dynamic_sidebar( $default_sidebar ); ?>
	<?php else : ?>
		<?php
			do_action( 'easy_store_action_shop_sidebar', $default_sidebar, 'shop-sidebar' );
		?>
	<?php endif; ?>
</div><!-- #sidebar-shop -->