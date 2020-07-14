<?php

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php easy_store_post_thumbnail(); ?>

	<div class="entry-content-wrapper">
        <div class="entry-content">
        	<div class="post-meta">
				<?php easy_store_inner_posted_on(); ?>
			</div>
			<?php
				the_content( sprintf(
					wp_kses(
