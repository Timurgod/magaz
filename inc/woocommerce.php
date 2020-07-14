<?php

function easy_store_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'easy_store_woocommerce_setup' );

function easy_store_woocommerce_scripts() {
	wp_enqueue_style( 'easy-store-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'easy-store-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'easy_store_woocommerce_scripts' );

function easy_store_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'easy_store_woocommerce_active_body_class' );

function easy_store_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'easy_store_woocommerce_related_products_args' );

	function easy_store_woocommerce_product_columns_wrapper() {
		$columns = get_option( 'woocommerce_catalog_columns', 4 );
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'easy_store_woocommerce_product_columns_wrapper', 40 );

	function easy_store_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'easy_store_woocommerce_product_columns_wrapper_close', 40 );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'easy_store_woocommerce_wrapper_before' ) ) {
	function easy_store_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'easy_store_woocommerce_wrapper_before' );

	function easy_store_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'easy_store_woocommerce_wrapper_after' );

	function easy_store_woocommerce_get_sidebar() {
		get_sidebar( 'shop' );
	}
	
endif;

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
add_action( 'woocommerce_sidebar', 'easy_store_woocommerce_get_sidebar', 10 );


if ( ! function_exists( 'easy_store_woocommerce_cart_link_fragment' ) ) {
	function easy_store_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		easy_store_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'easy_store_woocommerce_cart_link_fragment' );

	function easy_store_woocommerce_cart_link() {

		$cart_label = apply_filters( 'easy_store_shopping_cart_label', __( 'Shopping Item', 'easy-store' ) );
?>
		<a class="cart-contents es-clearfix" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'easy-store' ); ?>">
if ( ! function_exists( 'easy_store_woocommerce_header_cart' ) ) {
	function easy_store_woocommerce_header_cart() {
		$easy_store_header_cart_option = get_theme_mod( 'easy_store_header_cart_option', 'show' );
		if ( $easy_store_header_cart_option == 'hide' ) {
			return;
		}
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
	?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php easy_store_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
					$instance = array(
						'title' => '',
					);

					the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
	<?php
	}
}

	function easy_store_no_product_found() {
?>
		<div class="es-no-product-found"><?php esc_html_e( 'No products found', 'easy-store' ); ?></div>
<?php
	}
endif;
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );

add_action( 'woocommerce_shop_loop_item_title', 'easy_store_product_title_wrap_open', 5 );
function easy_store_product_title_wrap_open() {
	echo '<div class="es-product-title-wrap">';
}

add_action( 'woocommerce_after_shop_loop_item_title', 'easy_store_product_title_wrap_close', 15 );
function easy_store_product_title_wrap_close() {
	echo '</div><!-- .es-product-title-wrap -->';
}

add_action( 'woocommerce_after_shop_loop_item', 'easy_store_product_buttons_wrap_open', 5 );
function easy_store_product_buttons_wrap_open() {
	echo '<div class="es-product-buttons-wrap">';
}

add_action( 'woocommerce_after_shop_loop_item', 'easy_store_product_buttons_wrap_close', 30 );
function easy_store_product_buttons_wrap_close() {
	echo '</div><!-- .es-product-buttons-wrap -->';
}

add_action( 'woocommerce_after_shop_loop_item', 'easy_store_wishlist_button', 20 );
function easy_store_wishlist_button() {
	if ( ! function_exists( 'YITH_WCWL' ) ) {
	    return;
	}
	global $product;
	$product_id = yit_get_product_id( $product );
	$current_product = wc_get_product( $product_id );
	$product_type = $current_product->get_type();
?>
	<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', intval( $product_id ) ) )?>" rel="nofollow" data-product-id="<?php echo esc_attr( $product_id ); ?>" data-product-type="<?php echo esc_attr( $product_type ); ?>" class="add_to_wishlist" >
		<?php
			$easy_store_wishlist_text = apply_filters( 'easy_store_product_wishlist_text', __( 'Add to Wishlist', 'easy-store' ) );
			echo esc_html( $easy_store_wishlist_text );
		?>
	</a>
<?php
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );


function woocommerce_template_loop_product_title() {
    echo '<a href="'. esc_url( get_permalink() ) .'"><h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2> </a>';
}