<?php

if ( ! function_exists( 'easy_store_footer_start' ) ) :
	function easy_store_footer_start() {
		echo '<footer id="colophon" class="site-footer" role="contentinfo">';
	}
endif;

if ( ! function_exists( 'easy_store_footer_widget_section' ) ) :
	function easy_store_footer_widget_section() {
		get_sidebar( 'footer' );
	}
endif;

if ( ! function_exists( 'easy_store_bottom_footer_start' ) ) :
	function easy_store_bottom_footer_start() {
		echo '<div class="bottom-footer es-clearfix">';
		echo '<div class="mt-container">';
	}
endif;

if ( ! function_exists( 'easy_store_footer_site_info_section' ) ) :
	function easy_store_footer_site_info_section() {
?>
		<div class="site-info">
			<span class="es-copyright-text">
				<?php 
					$easy_store_copyright_text = get_theme_mod( 'easy_store_copyright_text', __( 'Easy Store', 'easy-store' ) );
					echo esc_html( $easy_store_copyright_text );
				?>
			</span>
			<span class="sep"> | </span>
			<?php
if ( ! function_exists( 'easy_store_footer_menu_section' ) ) :
	function easy_store_footer_menu_section() {
?>
		<nav id="footer-navigation" class="footer-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'easy_store_footer_menu', 'menu_id' => 'footer-menu', 'fallback_cb' => false ) );
			?>
		</nav><!-- #site-navigation -->
<?php
	}
endif;

if ( ! function_exists( 'easy_store_bottom_footer_end' ) ) :
	function easy_store_bottom_footer_end() {
		echo '</div><!-- .mt-container -->';
		echo '</div> <!-- bottom-footer -->';
	}
endif;

if ( ! function_exists( 'easy_store_footer_end' ) ) :
	function easy_store_footer_end() {
		echo '</footer><!-- #colophon -->';
	}
endif;


if ( ! function_exists( 'easy_store_go_top' ) ) :
	function easy_store_go_top() {
		echo '<div id="es-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>';
	}
endif;

add_action( 'easy_store_footer', 'easy_store_footer_start', 5 );
add_action( 'easy_store_footer', 'easy_store_footer_widget_section', 10 );
add_action( 'easy_store_footer', 'easy_store_bottom_footer_start', 15 );
add_action( 'easy_store_footer', 'easy_store_footer_site_info_section', 20 );
add_action( 'easy_store_footer', 'easy_store_footer_menu_section', 25 );
add_action( 'easy_store_footer', 'easy_store_bottom_footer_end', 30 );
add_action( 'easy_store_footer', 'easy_store_footer_end', 35 );
add_action( 'easy_store_footer', 'easy_store_go_top', 40 );