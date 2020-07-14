<?php
?>
<form method="get" class ="search-form" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'easy-store' ); ?>" />
	<button type="submit" class="submit fa fa-search" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'easy-store' ); ?>" />
</form>